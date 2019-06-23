<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Library */

$this->title = '新增图书馆';
$this->params['breadcrumbs'][] = ['label' => '图书馆', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="library-create">

    <!-- <h1><//?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
