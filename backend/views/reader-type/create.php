<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ReaderType */

$this->title = 'Create Reader Type';
$this->params['breadcrumbs'][] = ['label' => 'Reader Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reader-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
