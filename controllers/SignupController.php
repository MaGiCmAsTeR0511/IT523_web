<?php

namespace app\controllers;

use Yii;
use app\models\Signup;
use app\models\SignupSearch;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;

/**
 * SignupController implements the CRUD actions for Signup model.
 */
class SignupController extends Controller
{

    /**
     * generate Mail after saving the Signupmodel
     */
    private function sendsignupmail($id)
    {
        $model = $this->findModel($id);

        Yii::$app->mailer->compose('signupmessage', ['token' => $model->token, 'invalid' => $model->invalid_date])->setFrom('it523@hohenauers.eu')->setTo($model->mail)->setSubject('Anmeldung bei Prototyp IT523 Kursverwaltung via Discord')->send();
    }


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
     * Creates a new Signup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Signup();

        if ($model->load(Yii::$app->request->post())) {

            $key = Yii::$app->getSecurity()->generateRandomString();
            $model->token = $key;
            $model->invalid_date = date('Y-m-d H:i:s', strtotime("+30 minutes"));

            if ($model->save()) {
                $this->sendsignupmail($model->id);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionSetpassword($token)
    {
        $signup = Signup::find()->where(['token' => $token])->one();
        if (strtotime($signup->invalid_date) > time()) {
            $usermodel = new User();
            

            return $this->render('setpassword',['model' => $usermodel]);
        }else{
            throw new ForbiddenHttpException('Der benutze Link ist leider abgelaufen!');
        }
        die('asdasdasd');
    }

    /**
     * Updates an existing Signup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Signup model.
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
     * Finds the Signup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Signup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Signup::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
