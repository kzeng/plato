<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BookCopy */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-copy-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <//?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'bar_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bookseller_id')->textInput() ?>

    <?= $form->field($model, 'price1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'collection_place_id')->textInput() ?>

    <?= $form->field($model, 'circulation_type_id')->textInput() ?>

    <?= $form->field($model, 'call_number_rules_id')->textInput() ?>

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
