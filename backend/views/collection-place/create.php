<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CollectionPlace */

$this->title = '新增馆藏地点';
$this->params['breadcrumbs'][] = ['label' => '馆藏地点', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="collection-place-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
