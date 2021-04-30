<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KursVeranstaltungen */

$this->title = Yii::t('app', 'Create Kurs Veranstaltungen');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kurs Veranstaltungens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kurs-veranstaltungen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modules' => $modules
    ]) ?>

</div>
