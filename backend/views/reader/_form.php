<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\Reader;

use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Reader */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reader-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'card_number')->textInput(['maxlength' => true]) ?>

    <!--<//?= $form->field($model, 'card_status')->textInput() ?>-->

    <?= $form->field($model, 'card_status')->dropDownList(Reader::getCardStatusOption()); ?>

    <?= $form->field($model, 'reader_name')->textInput(['maxlength' => true]) ?>

    <?php
        echo '<label class="control-label">有效期限</label>';
        echo DatePicker::widget([
            'name' => 'Reader[validity]',
            'value' => Yii::$app->formatter->asDate($model->validity),

            'options' => ['placeholder' => ''],

            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true
            ]
        ]);
    ?>
  
    <?= $form->field($model, 'id_card')->textInput(['maxlength' => true]) ?>

    <!--<//?= $form->field($model, 'reader_type_id')->textInput() ?>-->

    <?= $form->field($model, 'reader_type_id')->dropDownList(Reader::getReaderTypeOption()); ?>

    <!--<//?= $form->field($model, 'gender')->textInput() ?>-->
    <?= $form->field($model, 'gender')->dropDownList(Reader::getGenderOption()); ?>

    <?= $form->field($model, 'deposit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

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
