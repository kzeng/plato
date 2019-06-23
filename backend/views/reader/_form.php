<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\date\DatePicker;

use common\models\Reader;
use common\models\ReaderType;

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
<!--
    <//?= $form->field($model, 'validity')->textInput() ?>
-->
    <div class="form-group field-reader-validity">
    <?php
            echo '<label class="control-label">有效期限</label>';
            echo DatePicker::widget([
                //'name' => 'validity',
                //'value' => '2019/6/22',
                'model' => $model,
                'attribute' => 'validity',

                'removeButton' => false,
                'pluginOptions' => [
                    'autoclose'=>true,
                    'todayHighlight' => true,
                    //'format' => 'mm/dd/yyyy'
                    'format' => 'yyyy/mm/dd'
                ]
            ]);
            
    ?>
    <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'id_card')->textInput(['maxlength' => true]) ?>

    <!--<//?= $form->field($model, 'reader_type_id')->textInput() ?>-->

    <?= $form->field($model, 'reader_type_id')->dropDownList(ReaderType::getReaderTypeOption()); ?>

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
