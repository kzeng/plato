<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

use pendalf89\filemanager\widgets\TinyMCE;

/* @var $this yii\web\View */
/* @var $model common\models\Library */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="library-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <!-- <label class="control-label" for="library-file">图书馆标识图片</label> -->
    <?php 
        // echo FileInput::widget([
        //     'name' => 'file',
        //     'pluginOptions' => [
        //         'showPreview' => false,
        //         'showCaption' => true,
        //         'showRemove' => true,
        //         'showUpload' => false
        //     ]
        // ]);
        echo $form->field($model, 'file')->widget(FileInput::classname(), [
            'options' => [
                'accept' => 'image/*',
                'multiple'=> false,
                'upload' => false,
            
            ],

        ]);
    ?>

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
    <!-- <//?= $form->field($model, 'user_id')->textInput() ?> -->

    <!-- <//?= $form->field($model, 'created_at')->textInput() ?>

    <//?= $form->field($model, 'updated_at')->textInput() ?>

    <//?= $form->field($model, 'status')->textInput() ?> -->

    <!--<//?= $form->field($model, 'pid')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('确定', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
