<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CollectionPlace */

$this->title = '馆藏地点修改: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '馆藏地点', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="collection-place-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
