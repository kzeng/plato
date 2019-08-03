<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use pendalf89\filemanager\widgets\TinyMCE;

use common\models\Events;

/* @var $this yii\web\View */
/* @var $model common\models\Events */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="events-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'event_type')->dropDownList(Events::getEventTypeOption()); ?>

    <?= $form->field($model, 'description')->textarea(['rows'=>5]) ?>
    <?php /* $form->field($model, 'description')->widget(TinyMCE::className(), [
        'clientOptions' => [
            'language' => 'zh_CN',
            'menubar' => false,
            //'menubar' => true,
            'height' => 280,
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
    ]);*/ ?>

    <div class="form-group">
        <?= Html::submitButton('确定', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
