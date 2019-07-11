<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BorrowReturnBooksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borrow-return-books-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <!-- <//?= $form->field($model, 'reader_id') ?> -->

    <?= $form->field($model, 'card_number') ?>

    <?= $form->field($model, 'bar_code') ?>

    <?= $form->field($model, 'operation') ?>

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
