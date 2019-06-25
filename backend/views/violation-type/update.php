<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ViolationType */

$this->title = '修改违章类型: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '违章类型', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="violation-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
