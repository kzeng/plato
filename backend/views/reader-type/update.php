<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ReaderType */

$this->title = '修改读者类型: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Reader Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="reader-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
