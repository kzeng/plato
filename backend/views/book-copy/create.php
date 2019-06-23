<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BookCopy */

$this->title = 'Create Book Copy';
$this->params['breadcrumbs'][] = ['label' => 'Book Copies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-copy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
