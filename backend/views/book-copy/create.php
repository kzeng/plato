<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BookCopy */

$this->title = '新增图书副本';
$this->params['breadcrumbs'][] = ['label' => '图书副本', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-copy-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
