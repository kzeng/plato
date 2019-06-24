<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Bookseller */

$this->title = '修改书商信息: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Booksellers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="bookseller-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
