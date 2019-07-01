<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ReadingRoom */

//$this->title = $model->title;
$this->title = "阅览室信息";
$this->params['breadcrumbs'][] = ['label' => '阅览室', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reading-room-view">

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '删除本条信息，确定?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description',
            // 'library_id',
            // 'user_id',
            // 'created_at:datetime',
            // 'updated_at:datetime',
            //'status',
        ],
    ]) ?>


    <div class="reading-room-form">
        <form id="w0">
            <div class="form-group field-readingroom-card_number">
                <label class="control-label" for="readingroom-card_number">读者证号</label>
                <input type="text" id="readingroom-card_number" class="form-control" maxlength="64">

                <div class="help-block"></div>
            </div>
            <div class="form-group">
                <button class="btn btn-success">签到</button>

                <a class="btn btn-primary" href="<?= Yii::$app->request->getHostInfo() ?>/reading-room-checkin?ReadingRoomCheckinSearch[reading_room_id]=<?= $model->id ?>">
                    浏览阅览室签到表
                </a>

            </div>
        </form>
    </div>

</div>