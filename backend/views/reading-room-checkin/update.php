<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ReadingRoomCheckin */

$this->title = '修改阅读室签到: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '阅读室签到管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="reading-room-checkin-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
