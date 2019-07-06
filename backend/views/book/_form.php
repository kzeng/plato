<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use pendalf89\filemanager\widgets\TinyMCE;

/* @var $this yii\web\View */
/* @var $model common\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'class_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'call_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'publisher')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'publication_place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'publish_date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'series_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(TinyMCE::className(), [
            'clientOptions' => [
                'language' => 'zh_CN',
                'menubar' => false,
                //'menubar' => true,
                'height' => 360,
                'image_dimensions' => false,
                //'image_dimensions' => true,
                //'image_prepend_url' => 'http://127.0.0.1/yii2-app-kit/backend/web',
                //'image_prepend_url' => Yii::getAlias('@backend'),
                //'image_prepend_url' => 'http://pf.mitoto.cn/admin',

                'plugins' => [
                    'advlist autolink lists link image media template textcolor colorpicker charmap print preview anchor searchreplace visualblocks code contextmenu table imagetools',
                ],
                'toolbar' => 'undo redo | styleselect | forecolor backcolor | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media',
            ],
        ]); ?>
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
