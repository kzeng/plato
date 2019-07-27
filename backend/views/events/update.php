<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Events */

$this->title = '修改事件: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '事件', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="events-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
