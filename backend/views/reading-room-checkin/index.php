<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\ReadingRoomCheckin;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReadingRoomCheckinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '阅读室签到管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reading-room-checkin-index">

    <p>
        <?= Html::a('新增', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'id',
                'headerOptions' => array('style'=>'width:10%;'),
            ],
            //'reader_id',
            'card_number',
            //'reading_room_id',
            [
                'attribute' => 'reading_room_id',
                'label' => '阅览室',
                'value'=>function ($model, $key, $index, $column) {
                    return ReadingRoomCheckin::getReadingRoomOption($model->reading_room_id);
                },
                'filter'=> ReadingRoomCheckin::getReadingRoomOption(),
                'headerOptions' => array('style'=>'width:20%;'),
            ],

            //'library_id',
            //'user_id',
            //'created_at',
            [
                'attribute' => 'created_at',
                'label' => '签到时间',
                'value'=>function ($model, $key, $index, $column) {
                    return  Yii::$app->formatter->asDateTime($model->created_at);
                },
                'headerOptions' => array('style'=>'width:30%;'),
            ],
            //'updated_at',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
