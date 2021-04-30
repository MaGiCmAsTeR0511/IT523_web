<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KursVeranstaltungenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kurs-veranstaltungen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_kv') ?>

    <?= $form->field($model, 'titel_kv') ?>

    <?= $form->field($model, 'von_kv') ?>

    <?= $form->field($model, 'bis_kv') ?>

    <?= $form->field($model, 'beschreibung_kv') ?>

    <?php // echo $form->field($model, 'sigdate_kv') ?>

    <?php // echo $form->field($model, 'sigid_kv') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
