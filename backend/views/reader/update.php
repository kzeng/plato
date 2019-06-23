<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Reader */

$this->title = '修改读者: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '读者', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="reader-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
