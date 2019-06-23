<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BorrowingRules */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Borrowing Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="borrowing-rules-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'general_loan_period',
            'extended_period_impunity',
            'first_term_of_punishment',
            'first_penalty_unit_price',
            'other__unit_price',
            'reader_type_ids',
            'circulation_type_ids',
            'library_id',
            'user_id',
            'created_at',
            'updated_at',
            'status',
        ],
    ]) ?>

</div>
