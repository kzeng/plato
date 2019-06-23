<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CollectionPlace */

$this->title = 'Create Collection Place';
$this->params['breadcrumbs'][] = ['label' => 'Collection Places', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collection-place-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
