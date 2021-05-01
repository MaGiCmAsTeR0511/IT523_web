<?php

use kartik\date\DatePicker;
use kartik\widgets\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\KursVeranstaltungen */
/* @var $form yii\widgets\ActiveForm */
/* @var $modules app\modes\ModulVeranstaltungen */
?>

<div class="kurs-veranstaltungen-form">

    <?php $form = ActiveForm::begin(['id' => 'kursveranstaltungen']); ?>

    <?= $form->field($model, 'titel_kv')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'beschreibung_kv')->textarea(['rows' => 6]) ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'von_kv')->widget(DatePicker::class, [
                'options' => ['placeholder' => 'Geben Sie bitte das Beginn Datum der Veranstaltung ein...'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy'
                ]
            ]); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'bis_kv')->widget(DatePicker::class, [
                'options' => ['placeholder' => 'Geben Sie bitte das Ende Datum der Veranstaltung ein...'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy'
                ]
            ]); ?>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4><i class="glyphicon glyphicon-book"></i> Modulveranstaltungen</h4>
        </div>
        <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modules[0],
                'formId' => 'kursveranstaltungen',
                'formFields' => [
                    'von_mv',
                    'bis_mv',
                    'titel_mv',
                    'beschreibung_mv',
                ],
            ]); ?>

            <div class="container-items">
                <!-- widgetContainer -->
                <?php foreach ($modules as $i => $modul) : ?>
                    <div class="item panel panel-default">
                        <!-- widgetBody -->
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Modulveranstaltung</h3>
                            <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (!$modul->isNewRecord) {
                                echo Html::activeHiddenInput($modul, "[{$i}]id");
                            }
                            ?>
                            <?= $form->field($modul, "[{$i}]titel_mv")->textInput(['maxlength' => true]) ?>
                            <div class="row">
                                <div class="col-sm-12">
                                    <?= $form->field($modul, "[{$i}]beschreibung_mv")->textarea(['rows' => 6]) ?>
                                </div>
                            </div><!-- .row -->
                            <div class="row">
                            <div class="col-sm-6">
                                    <?= $form->field($modul, "[{$i}]von_mv")->widget(DatePicker::class, [
                                        'options' => ['placeholder' => 'Geben Sie bitte das Beginn Datum des Moduls ein...'],
                                        'pluginOptions' => [
                                            'autoclose' => true,
                                            'format' => 'dd.mm.yyyy hh:ii:ss'
                                        ]
                                    ]); ?>
                                </div>
                                <div class="col-sm-6">
                                    <?= $form->field($modul, "[{$i}]bis_mv")->widget(DatePicker::class, [
                                        'options' => ['placeholder' => 'Geben Sie bitte das Ende Datum des Moduls ein...'],
                                        'pluginOptions' => [
                                            'autoclose' => true,
                                            'format' => 'dd.mm.yyyy hh:ii:ss'
                                        ]
                                    ]) ?>
                                </div>
                            </div><!-- .row -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>