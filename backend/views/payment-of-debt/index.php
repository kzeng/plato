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
        <?= Html::a('新增缴纳欠费', ['create'], ['class' => 'btn btn-success']) ?>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <?= Html::a('新增违章类型', ['violation-type/index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'table-responsive'],
        // 'rowOptions' => function($model){
        //     if($model->payment_status ==1)
        //     {
        //         return ['class' => 'success'];
        //     }
        //     else
        //     {
        //         return ['class' => 'danger'];
        //     }
        // },
        'layout'=>"{items}\n{summary}{pager}",
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'headerOptions' => array('style'=>'width:10%;'),
            ],

            [
                'label'     => '卡号',
                'attribute' => 'card_number',
                'value'     => 'reader.card_number',
                'headerOptions' => array('style'=>'width:20%;'),
            ],

            //'reader_name',
            [
                'label'     => '读者姓名',
                'attribute' => 'reader_name',
                'value'     => 'reader.reader_name',
                'headerOptions' => array('style'=>'width:20%;'),
            ],


            //'violation_type_id',
            // 'violationType.title',
            [
                'label'     => '违章类型',
                'attribute' => 'violation_type_id',
                'value'     => 'violationType.title',
                'filter'=> PaymentOfDebt::getViolationTypeOption(),
            ],

            //'payment_status',
            [
                'attribute' => 'payment_status',
                'label' => '缴费状态',
                'value'=>function ($model, $key, $index, $column) {
                    if($model->payment_status == 1)
                        return "<span class=\"badge label-success\">".PaymentOfDebt::getPaymentStatusOption($model->payment_status)."</span>";
                    else
                        return "<span class=\"badge label-danger\">".PaymentOfDebt::getPaymentStatusOption($model->payment_status)."</span>";
                },
                'filter'=> PaymentOfDebt::getPaymentStatusOption(),
                'headerOptions' => array('style'=>'width:12%;'),
                'format' => 'html',
            ],

            [
                'attribute' => 'penalty',
                'headerOptions' => array('style'=>'width:10%;'),
            ],
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
        'layout'=>"{items}\n{summary}{pager}",
    ]); ?>


</div>
