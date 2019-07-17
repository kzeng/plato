<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\ReadingRoomCheckin;
/* @var $this yii\web\View */
/* @var $model common\models\ReadingRoomCheckin */

//$this->title = $model->id;

$this->title = '阅览室签到信息';
$this->params['breadcrumbs'][] = ['label' => '阅览室签到管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reading-room-checkin-view">

    <p>
        <?= Html::a('<i class="fa fa-edit"></i> 修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-trash-o"></i> 删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '删除本条记录，确定?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'reader_id',
 
            'card_number',
            //'reading_room_id',
            [
                'label' => '阅览室',
                'value' => ReadingRoomCheckin::getReadingRoom($model),
                'format'=> 'html',
            ],

            // 'library_id',
            // 'user_id',
            'created_at:datetime',
            //'updated_at',
            //'status',
        ],
    ]) ?>

</div>
