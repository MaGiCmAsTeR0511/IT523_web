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

use Exception;
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
        return $this->render('view', [
            'model' => $this->findModel($id),
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
            // validate all models
            $valid = $model->validate();

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    $model->sigdate_kv = date('Y-m-d H:i:s');
                    $model->sigid_kv = $user->id;
                    if ($flag = $model->save()) {
                        foreach ($modules as $modul) {
                            $modul->von_mv = date('Y-m-d H:i:s', strtotime($modul->von_mv));
                            $modul->bis_mv = date('Y-m-d H:i:s', strtotime($modul->bis_mv));
                            $modul->idkv_mv = $model->id_kv;
                            $modul->sigdate_mv = date('Y-m-d H:i:s');
                            $modul->sigid_mv = $user->id;
                            if (!($flag = $modul->save())) {
                                die('Asdasdasd');
                                $transaction->rollBack();
                                break;
                            } 
                        }
                    }else{
                        die('asdasdasdasd');
                    }
                    var_dump($flag);
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_kv]);
        }

        return $this->render('update', [
            'model' => $model,
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
        $this->findModel($id)->delete();

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
        if (($model = KursVeranstaltungen::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
