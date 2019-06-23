<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Reader */

$this->title = '新增读者';
$this->params['breadcrumbs'][] = ['label' => '读者', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reader-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
