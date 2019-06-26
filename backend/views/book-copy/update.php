<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BookCopy */

$this->title = '修改图书副本信息: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '图书副本', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="book-copy-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
