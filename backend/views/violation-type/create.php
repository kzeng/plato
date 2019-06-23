<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ViolationType */

$this->title = 'Create Violation Type';
$this->params['breadcrumbs'][] = ['label' => 'Violation Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="violation-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
