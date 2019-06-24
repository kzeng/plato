<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ReadingRoom */

$this->title = '修改阅览室信息: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '阅览室', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="reading-room-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
