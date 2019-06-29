<?php

use yii\helpers\Html;
use yii\grid\GridView;

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

            'id',
            'reader_id',
            'card_number',
            'reading_room_id',
            //'library_id',
            //'user_id',
            'created_at',
            //'updated_at',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
