<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\Events;
/* @var $this yii\web\View */
/* @var $searchModel common\models\EventsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '日历事件';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="events-index">

    <p>
        <?= Html::a('新增事件', ['create'], ['class' => 'btn btn-success']) ?>
    </p>



<?= \yii2fullcalendar\yii2fullcalendar::widget(array(
        'events'=> $events,
        'options' => [
            'lang' => 'zh-cn',
            //... more options to be defined here!
        ],
        ));
    ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<!-- 
    <//?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'headerOptions' => array('style'=>'width:10%;'),
            ],

            'title',
            // 'event_type',
            [
                'attribute' => 'event_type',
                'label' => '事件类型',
                'value'=>function ($model, $key, $index, $column) {
                    return Events::getEventTypeOption($model->event_type);
                },
                'filter'=> Events::getEventTypeOption(),
                'headerOptions' => array('style'=>'width:15%;'),
            ],
            //'description:ntext',
            //'library_id',
            //'user_id',
            'created_at:datetime',
            //'updated_at',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?> -->


</div>
