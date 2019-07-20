<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\PaymentOfDebt;

/* @var $this yii\web\View */
/* @var $model common\models\PaymentOfDebt */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-of-debt-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'card_number')->textInput(['maxlength' => true]) ?>

    <!-- <//?= $form->field($model, 'reader_name')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'violation_type_id')->dropDownList(PaymentOfDebt::getViolationTypeOption()); ?>

    <?= $form->field($model, 'payment_status')->dropDownList(PaymentOfDebt::getPaymentStatusOption()); ?>

    <?= $form->field($model, 'penalty')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
<!-- 
    <//?= $form->field($model, 'library_id')->textInput() ?>

    <//?= $form->field($model, 'user_id')->textInput() ?>

    <//?= $form->field($model, 'created_at')->textInput() ?>

    <//?= $form->field($model, 'updated_at')->textInput() ?>

    <//?= $form->field($model, 'status')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('确定', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
