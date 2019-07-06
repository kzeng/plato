<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BorrowReturnBooks */

$this->title = '新增';
$this->params['breadcrumbs'][] = ['label' => '借还书管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrow-return-books-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
