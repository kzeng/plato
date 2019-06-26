<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BorrowingRules */

$this->title = '修改借阅规则: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '借阅规则', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="borrowing-rules-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
