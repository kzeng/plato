<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CallNumberRules */
/* @var $form yii\widgets\ActiveForm */

use nex\chosen\Chosen;

use common\models\CollectionPlace; // 馆藏地点
use common\models\CirculationType; // 流通类型
?>

<div class="call-number-rules-form">
    <?= $this->render('/layouts/form_error', [
        'model' => $model,
    ]) ?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'collectionPlace')->label('馆藏地点')->widget(Chosen::className(), [
        'items' => CollectionPlace::find()->select(['title', 'id'])->indexBy('id')->column(),
        'multiple' => true,
        'disableSearch' => 8,
        'clientOptions' => [
            'search_contains' => true,
            'single_backstroke_delete' => false,
        ],
    ]);?>
    <?= $form->field($model, 'circulationType')->label('流通类型')->widget(Chosen::className(), [
        'items' => CirculationType::find()->select(['title', 'id'])->indexBy('id')->column(),
        'multiple' => true,
        'disableSearch' => 8,
        'clientOptions' => [
            'search_contains' => true,
            'single_backstroke_delete' => false,
        ],
    ]);?>

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
