<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\KursVeranstaltungen */
/* @var $modulveranstaltungen app\models\ModulVeranstaltungen */

$this->title = $model->titel_kv;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kurs Veranstaltungens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="kurs-veranstaltungen-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id_kv], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id_kv], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_kv',
            'beschreibung_kv:ntext',
            'titel_kv',
            'von_kv:date',
            'bis_kv:date',
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $modulveranstaltungen,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'titel_mv',
            'beschreibung_mv:ntext',
            'von_mv:datetime',
            'bis_mv:datetime'
        ]
    ]) ?>

</div>