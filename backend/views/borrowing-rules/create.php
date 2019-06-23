<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BorrowingRules */

$this->title = 'Create Borrowing Rules';
$this->params['breadcrumbs'][] = ['label' => 'Borrowing Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrowing-rules-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
