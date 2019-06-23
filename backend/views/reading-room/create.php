<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ReadingRoom */

$this->title = 'Create Reading Room';
$this->params['breadcrumbs'][] = ['label' => 'Reading Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reading-room-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
