<?php

use yii\helpers\Html;
use yii\grid\GridView;

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

            'id',
            'card_number',
            'reader_name',
            'violation_type_id',
            'payment_status',
            'penalty',
            //'description',
            //'library_id',
            //'user_id',
            //'created_at',
            //'updated_at',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
