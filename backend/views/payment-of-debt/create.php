<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PaymentOfDebt */

$this->title = 'Create Payment Of Debt';
$this->params['breadcrumbs'][] = ['label' => 'Payment Of Debts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-of-debt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
