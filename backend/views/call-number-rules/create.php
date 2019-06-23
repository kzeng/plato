<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CallNumberRules */

$this->title = 'Create Call Number Rules';
$this->params['breadcrumbs'][] = ['label' => 'Call Number Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="call-number-rules-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
