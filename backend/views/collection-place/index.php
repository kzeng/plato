<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CollectionPlaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '馆藏地点管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collection-place-index">
    <p>
        <?= Html::a('新增馆藏地点', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'headerOptions' => array('style'=>'width:10%;'),
            ],

            'title',
            'description',
            //'library_id',
            //'user_id',

            //'created_at',
            //'updated_at',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
