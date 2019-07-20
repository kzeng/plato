<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PaymentOfDebt */

//$this->title = $model->id;
$this->title = "缴纳欠费信息";
$this->params['breadcrumbs'][] = ['label' => '缴纳欠费', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="payment-of-debt-view">

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
            'card_number',
            //'reader_name',
            
            //'violation_type_id',
            'violationType.title',
            //'payment_status',
            [
                'label' => '缴费状态',
                'value' => $model->getPaymentStatus($model),
                'format'=> 'html',
            ],
            'penalty',
            'description',
            // 'library_id',
            // 'user_id',
            // 'created_at:datetime',
            // 'updated_at:datetime',
            //'status',
        ],
    ]) ?>

</div>
