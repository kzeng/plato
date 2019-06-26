<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PaymentOfDebt */

$this->title = '修改缴纳欠费: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '缴纳欠费', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="payment-of-debt-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
