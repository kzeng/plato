<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\PaymentOfDebt;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PaymentOfDebtSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '缴纳欠费管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-of-debt-index">

    <p>
        <?= Html::a('新增', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'table-responsive'],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'headerOptions' => array('style'=>'width:8%;'),
            ],
            'card_number',
            'reader_name',
            //'violation_type_id',
            // 'violationType.title',
            [
                'label'     => '违章类型',
                'attribute' => 'violation_type_id',
                'value'     => 'violationType.title',
            ],
            //'payment_status',
            [
                'attribute' => 'payment_status',
                'label' => '缴费状态',
                'value'=>function ($model, $key, $index, $column) {
                    return PaymentOfDebt::getPaymentStatusOption($model->payment_status);
                },
                'filter'=> PaymentOfDebt::getPaymentStatusOption(),
                'headerOptions' => array('style'=>'width:12%;'),
            ],
            'penalty',
            //'description',
            //'library_id',
            //'user_id',
            //'created_at',
            //'updated_at',
            //'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => array('style'=>'width:10%;'),
            ],

        ],
    ]); ?>


</div>
