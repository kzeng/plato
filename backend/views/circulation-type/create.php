<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CirculationType */

$this->title = 'Create Circulation Type';
$this->params['breadcrumbs'][] = ['label' => 'Circulation Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="circulation-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
