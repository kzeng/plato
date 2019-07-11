<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BorrowReturnBooks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="borrow-return-books-form">

    <?php $form = ActiveForm::begin(); ?>
<!-- 
    <//?= $form->field($model, 'reader_id')->textInput() ?> 
-->

    <?= $form->field($model, 'card_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bar_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'operation')->textInput() ?>

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
