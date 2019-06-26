<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BorrowingRules */

$this->title = '新增借阅规则';
$this->params['breadcrumbs'][] = ['label' => '借阅规则', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrowing-rules-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
