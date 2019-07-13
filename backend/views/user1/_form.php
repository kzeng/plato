<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\User1;

/* @var $this yii\web\View */
/* @var $model common\models\User1 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user1-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <!-- <//?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <!-- <//?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <!-- <//?= $form->field($model, 'status')->textInput() ?> -->

    <!-- <//?= $form->field($model, 'created_at')->textInput() ?>

    <//?= $form->field($model, 'updated_at')->textInput() ?>

    <//?= $form->field($model, 'verification_token')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <!-- <//?= $form->field($model, 'library_id')->textInput() ?> -->

    <?php
        if( Yii::$app->user->id == 1) /* 超级管理员可以把新增的馆员分配到指定图书馆*/
        {
            echo $form->field($model, 'library_id')->dropDownList(User1::getLibraryOption());
        }
        else
        {
            echo $form->field($model, 'library_id')->hiddenInput()->label(false);
        }
    ?>

    <!--<//?= $form->field($model, 'pid')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('确定', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
