<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BorrowingRules */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borrowing-rules-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'general_loan_period')->textInput() ?>

    <?= $form->field($model, 'extended_period_impunity')->textInput() ?>

    <?= $form->field($model, 'first_term_of_punishment')->textInput() ?>

    <?= $form->field($model, 'first_penalty_unit_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'other__unit_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reader_type_ids')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'circulation_type_ids')->textInput(['maxlength' => true]) ?>

    <!-- <//?= $form->field($model, 'library_id')->textInput() ?>

    <//?= $form->field($model, 'user_id')->textInput() ?>

    <//?= $form->field($model, 'created_at')->textInput() ?>

    <//?= $form->field($model, 'updated_at')->textInput() ?>

    <//?= $form->field($model, 'status')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('确定', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
