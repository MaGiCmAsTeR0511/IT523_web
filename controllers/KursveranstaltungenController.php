<?php

namespace app\controllers;

use app\assets\KursverwaltungAsset;
use Yii;
use app\models\KursVeranstaltungen;
use app\models\KursVeranstaltungenSearch;
use app\models\ModulVeranstaltungen;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;
use app\models\SendUpdatesToDc;
use app\models\SendUpdatesToUser;
use app\models\UserToKursveranstaltung;
use Exception;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * KursvernstaltungenController implements the CRUD actions for KursVeranstaltungen model.
 */
class KursveranstaltungenController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all KursVeranstaltungen models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KursVeranstaltungenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single KursVeranstaltungen model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $anmeldungen = UserToKursveranstaltung::find()->where(['idkv_utkv' => $model->id_kv])->select(['iduser_utkv'])->groupBy(['iduser_utkv'])->count();
        $modulveraProvider = new ActiveDataProvider([
            'query' => ModulVeranstaltungen::find()->where(['idkv_mv' => $model->id_kv]),
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        return $this->render('view', [
            'model' => $model,
            'modulveranstaltungen' => $modulveraProvider,
            'anmeldungen' => $anmeldungen
        ]);
    }

    /**
     * Creates a new KursVeranstaltungen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        KursverwaltungAsset::register($this->view);
        $user = Yii::$app->user;
        $model = new KursVeranstaltungen();

        $modules = [new ModulVeranstaltungen()];
        if ($model->load(Yii::$app->request->post())) {

            $modules = Model::createMultiple(ModulVeranstaltungen::class);
            Model::loadMultiple($modules, Yii::$app->request->post());
            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modules),
                    ActiveForm::validate($model)
                );
            }

            $model->von_kv = date('Y-m-d', strtotime($model->von_kv));
            $model->bis_kv = date('Y-m-d', strtotime($model->bis_kv));
            $model->sigid_kv = $user->id;
            $model->sigdate_kv = date('Y-m-d H:i:s');
            $model->deleted_kv = 0;
            // validate all models
            $valid = $model->validate();

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save()) {

                        foreach ($modules as $modul) {
                            $modul->von_mv = date('Y-m-d H:i:s', strtotime($modul->von_mv));
                            $modul->bis_mv = date('Y-m-d H:i:s', strtotime($modul->bis_mv));
                            $modul->idkv_mv = $model->id_kv;
                            $modul->sigdate_mv = date('Y-m-d H:i:s');
                            $modul->sigid_mv = $user->id;
                            if (!($flag = $modul->save())) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        // Save user to Kursveranstaltung
                        $utk = new UserToKursveranstaltung();
                        $utk->iduser_utkv = $user->id;
                        $utk->idkv_utkv = $model->id_kv;
                        if (!$utk->save()) {
                            throw new Exception('user zu Kursveranstaltung nicht gespeichert!');
                        }

                        $sutd = new SendUpdatesToDc();
                        $sutd->idkv_sudc = $model->id_kv;
                        if (!$sutd->save()) {
                            throw new Exception('Send updates to DC konnte nicht gespeichert werden');
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id_kv]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modules' => (empty($modules)) ? [new ModulVeranstaltungen()] : $modules
        ]);
    }

    /**
     * Updates an existing KursVeranstaltungen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        KursverwaltungAsset::register($this->view);
        $user = Yii::$app->user;
        $model = $this->findModel($id);
        $model->von_kv = date('d.m.Y', strtotime($model->von_kv));
        $model->bis_kv = date('d.m.Y', strtotime($model->bis_kv));
        $modules = $model->modulVeranstaltungens;

        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modules, 'id_mv', 'id_mv');
            $modules = Model::createMultiple(ModulVeranstaltungen::class, $modules);
            Model::loadMultiple($modules, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modules, 'id_mv', 'id_mv')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modules),
                    ActiveForm::validate($model)
                );
            }

            // validate all models
            $valid = $model->validate();
            //$valid = Model::validateMultiple($modules) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    $model->von_kv = date('Y-m-d', strtotime($model->von_kv));
                    $model->bis_kv = date('Y-m-d', strtotime($model->bis_kv));
                    $model->sigdate_kv = date('Y-m-d H:i:s');
                    $model->sigid_kv = $user->id;
                    if ($flag = $model->save()) {
                        if (!empty($deletedIDs)) {
                            ModulVeranstaltungen::deleteAll(['id_mv' => $deletedIDs]);
                        }
                        foreach ($modules as $module) {
                            $module->von_mv = date('Y-m-d H:i:s', strtotime($module->von_mv));
                            $module->bis_mv = date('Y-m-d H:i:s', strtotime($module->bis_mv));
                            $module->sigdate_mv = date('Y-m-d H:i:s');
                            $module->sigid_mv = $user->id;
                            if (!($flag = $module->save())) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        $sutd = new SendUpdatesToUser();
                        $sutd->idkv_sutu = $model->id_kv;
                        if (!$sutd->save()) {
                            throw new Exception('Send updates to DC konnte nicht gespeichert werden');
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id_kv]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modules' => (empty($modules)) ? [new ModulVeranstaltungen()] : $modules
        ]);
    }

    /**
     * Deletes an existing KursVeranstaltungen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->deleted_kv = 1;

        return $this->redirect(['index']);
    }

    /**
     * Finds the KursVeranstaltungen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KursVeranstaltungen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KursVeranstaltungen::find()->where(['id_kv' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
