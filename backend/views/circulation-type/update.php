<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CirculationType */

$this->title = '修改流通类型: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '流通类型', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="circulation-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
