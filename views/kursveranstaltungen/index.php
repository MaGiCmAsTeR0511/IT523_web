<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KursVeranstaltungenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Kurs Veranstaltungens');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kurs-veranstaltungen-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Kurs Veranstaltungen'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model) {
            if ($model->deleted_kv === 1) {
                return ['class' => 'danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_kv',
            'titel_kv',
            'beschreibung_kv:ntext',
            'von_kv:date',
            'bis_kv:date',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>