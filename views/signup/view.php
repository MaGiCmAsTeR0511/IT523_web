<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Signup */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Signups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="signup-view">

    <h1>Vielen Dank für ihre Anmeldung bei unserem Prototypen!</h1>

    <div>Sie sollten in den näcshten paar Minuten ein Mail an die von Ihnen eingegeben Adresse erhalten. Dort finden Sie einen Link. Dieser Link ist bis <?= Yii::$app->formatter->asDatetime($model->invalid_date) ?> gültig!</div>

</div>