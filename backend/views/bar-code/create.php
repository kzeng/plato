<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BarCode */

$this->title = '新增条码号序列';
$this->params['breadcrumbs'][] = ['label' => '条码号序列', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bar-code-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
