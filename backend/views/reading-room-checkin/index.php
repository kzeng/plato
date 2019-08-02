<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\ReadingRoomCheckin;
use common\models\Reader;

use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReadingRoomCheckinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '阅读室签到管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reading-room-checkin-index">

<!--     
    <p>
        <//?= Html::a('新增', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
 -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'table-responsive'],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'id',
                'headerOptions' => array('style'=>'width:10%;'),
            ],
            //'reader_id',
            'card_number',
            // [
            //     'attribute' => 'reader_id',
            //     'label' => '读者姓名',
            //     'value'=>function ($model, $key, $index, $column) {
            //         $reader = Reader::findOne(['id' => $model->reader_id]);
            //         if(!empty($reader))
            //         {
            //             return $reader->reader_name;
            //         }
            //         else 
            //         {
            //             return "n/a";
            //         }
            //     },
            //     'headerOptions' => array('style'=>'width:15%;'),
            // ],
            [
                'label' => '读者姓名',
                'attribute' => 'reader_name',
                'value'     => 'reader.reader_name',
            ],

            //'reading_room_id',
            [
                'attribute' => 'reading_room_id',
                'label' => '阅览室',
                'value'=>function ($model, $key, $index, $column) {
                    return ReadingRoomCheckin::getReadingRoomOption($model->reading_room_id);
                },
                'filter'=> ReadingRoomCheckin::getReadingRoomOption(),
                'headerOptions' => array('style'=>'width:15%;'),
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
                'filter' => DateRangePicker::widget([
                    'model' => $searchModel,
                    'presetDropdown'=>true,
                    'attribute' => 'created_at_range',
                    'pluginOptions' => [
                    'format' => 'd-m-Y',
                    'autoUpdateInput' => false
                ]
                ]),
                'headerOptions' => array('style'=>'width:25%;'),
            ],
            //'updated_at',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'layout'=>"{items}\n{summary}{pager}",
    ]); ?>


</div>
