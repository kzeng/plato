<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReadingRoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '阅览室管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reading-room-index">

    <p>
        <?= Html::a('新增阅览室', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'table-responsive'],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'headerOptions' => array('style'=>'width:10%;'),
            ],
            'title',
            'description',
            [
                'label' => '今日签到人数',
                'value' => function($model){
                    $reading_room_checkin_count = common\models\ReadingRoomCheckin::find()
                                            ->where(['reading_room_id' => $model->id])
                                            ->andWhere(['between', 'created_at', strtotime(date('Y-m-d', time()).' 00:00:01'), strtotime(date('Y-m-d', time()). ' 23:59:59')])
                                            ->count();
                    
                    return $reading_room_checkin_count;
                },
            ],
            //'library_id',
            //'user_id',
            //'created_at',
            //'updated_at',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'layout'=>"{items}\n{summary}{pager}",
    ]); ?>


</div>
