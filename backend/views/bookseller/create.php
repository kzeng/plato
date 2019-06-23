<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Bookseller */

$this->title = 'Create Bookseller';
$this->params['breadcrumbs'][] = ['label' => 'Booksellers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bookseller-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
