<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BorrowingRules */
/* @var $form yii\widgets\ActiveForm */

use nex\chosen\Chosen;

use common\models\ReaderType; // 读者类型
use common\models\CirculationType; // 流通类型
?>

<div class="borrowing-rules-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'general_loan_period')->textInput() ?>

    <?= $form->field($model, 'extended_period_impunity')->textInput() ?>

    <?= $form->field($model, 'first_term_of_punishment')->textInput() ?>

    <?= $form->field($model, 'first_penalty_unit_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'other__unit_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reader_type_ids')->widget(Chosen::className(), [
        'items' => ReaderType::find()->select(['title', 'id'])->indexBy('id')->column(),
        'multiple' => true,
        'disableSearch' => 8,
        'clientOptions' => [
            'search_contains' => true,
            'single_backstroke_delete' => false,
        ],
    ]);?>
    <?= $form->field($model, 'circulation_type_ids')->widget(Chosen::className(), [
        'items' => CirculationType::find()->select(['title', 'id'])->indexBy('id')->column(),
        'multiple' => true,
        'disableSearch' => 8,
        'clientOptions' => [
            'search_contains' => true,
            'single_backstroke_delete' => false,
        ],
    ]);?>

    <div class="form-group">
        <?= Html::submitButton('确定', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
