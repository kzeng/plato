<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CirculationType */

$this->title = '新增流通类型';
$this->params['breadcrumbs'][] = ['label' => '流通类型', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="circulation-type-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
