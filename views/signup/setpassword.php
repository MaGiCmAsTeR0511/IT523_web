<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Userdb */

$this->title = Yii::t('app', 'Create Password');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Signups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="signup-form">

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'password')->passwordInput() ?>

<?= $form->field($model, 'repeatpassword')->passwordInput() ?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
