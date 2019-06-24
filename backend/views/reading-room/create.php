<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ReadingRoom */

$this->title = '新增阅览室';
$this->params['breadcrumbs'][] = ['label' => 'Reading Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reading-room-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
