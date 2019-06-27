<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Book */

$this->title = '新增图书信息';
$this->params['breadcrumbs'][] = ['label' => '图书', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
