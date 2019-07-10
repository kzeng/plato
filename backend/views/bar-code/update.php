<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BarCode */

$this->title = '修改条码号序列设置: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '条码号序列', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="bar-code-update">
	<?= $this->render('/layouts/form_error', [
        'model' => $model,
    ]) ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
