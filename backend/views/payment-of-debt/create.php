<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PaymentOfDebt */

$this->title = '新增缴纳欠费';
$this->params['breadcrumbs'][] = ['label' => '缴纳欠费', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-of-debt-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
