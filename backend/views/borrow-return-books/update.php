<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BorrowReturnBooks */

$this->title = '借还书管理: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '借还书', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="borrow-return-books-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
