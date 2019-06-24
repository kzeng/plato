<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Bookseller */

$this->title = '新增书商';
$this->params['breadcrumbs'][] = ['label' => '书商', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bookseller-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
