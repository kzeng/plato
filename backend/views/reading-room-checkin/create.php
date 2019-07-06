<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ReadingRoomCheckin */

$this->title = '新增阅读室签到';
$this->params['breadcrumbs'][] = ['label' => '阅读室签到管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reading-room-checkin-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
