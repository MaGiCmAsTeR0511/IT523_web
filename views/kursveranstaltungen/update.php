<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KursVeranstaltungen */

$this->title = Yii::t('app', 'Update Kurs Veranstaltungen: {name}', [
    'name' => $model->id_kv,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kurs Veranstaltungens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_kv, 'url' => ['view', 'id' => $model->id_kv]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="kurs-veranstaltungen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
