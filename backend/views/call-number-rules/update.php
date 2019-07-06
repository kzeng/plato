<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CallNumberRules */

$this->title = '修改所属号规则: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '索书号管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="call-number-rules-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
