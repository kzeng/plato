<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BarCode */

$this->title = 'Create Bar Code';
$this->params['breadcrumbs'][] = ['label' => 'Bar Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bar-code-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
