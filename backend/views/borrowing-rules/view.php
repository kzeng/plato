<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BorrowingRules */

// $this->title = $model->title;
$this->title = "借阅规则信息";
$this->params['breadcrumbs'][] = ['label' => '借阅规则', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="borrowing-rules-view">

    <p>
        <?= Html::a('<i class="fa fa-edit"></i> 修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-trash-o"></i> 删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '删除本条记录，确定?',
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
            [
                'format' => 'html',
                'attribute' => 'readerTypes',
            ],
            [
                'format' => 'html',
                'attribute' => 'circulationTypes',
            ],
            // 'library_id',
            // 'user_id',
            // 'created_at:datetime',
            // 'updated_at:datetime',
            //'status',
        ],
    ]) ?>

</div>
