<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BorrowingRulesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borrowing-rules-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'general_loan_period') ?>

    <?= $form->field($model, 'extended_period_impunity') ?>

    <?= $form->field($model, 'first_term_of_punishment') ?>

    <?php // echo $form->field($model, 'first_penalty_unit_price') ?>

    <?php // echo $form->field($model, 'other__unit_price') ?>

    <?php // echo $form->field($model, 'reader_type_ids') ?>

    <?php // echo $form->field($model, 'circulation_type_ids') ?>

    <?php // echo $form->field($model, 'library_id') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
