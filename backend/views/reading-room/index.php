<?php
use yii\helpers\Html;
use yii\grid\GridView;

use common\models\ReadingRoom;
use common\models\User1;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ReadingRoomSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '阅览室管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reading-room-index">

    <p>
        <div class="btn-group">
        <!-- Single button -->
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        切换阅览室签到 <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
        <?php 
            $user_id = Yii::$app->user->id;
            $library_id = User1::getCurrentLibraryId(Yii::$app->user->id);
            $reading_rooms = ReadingRoom::find()->where(['library_id' => $library_id])->all();
            foreach($reading_rooms as $reading_room)
            {
        ?>
         <li> <?= Html::a($reading_room->title, ['view', 'id'=>$reading_room->id], []) ?></li>
        <?php
            }
        ?>
        </ul>
        </div>
        &nbsp;&nbsp;
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
