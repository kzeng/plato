<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Library */

$this->title = '修改配置: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '图书馆', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="library-update">

    <!-- <h1><//?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
