<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ReaderType */

$this->title = '新增读者类型';
$this->params['breadcrumbs'][] = ['label' => '读者类型', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reader-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
