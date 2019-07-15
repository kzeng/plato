<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\BorrowReturnBooks;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BorrowReturnBooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '借还书管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrow-return-books-index">

    <p>
        <?= Html::a('新增', ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::a('<i class="fa fa-exchange"></i> 流通借还详情', ['detail'], ['class' => 'btn btn-primary pull-right']) ?>
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
            //reader_id',
            'card_number',
            'bar_code',
            //'operation',

            [
                'attribute' => 'operation',
                'label' => '操作',
                'value'=>function ($model, $key, $index, $column) {
                    return BorrowReturnBooks::getOperationOption($model->operation);
                },
                'filter'=> BorrowReturnBooks::getOperationOption(),
                'headerOptions' => array('style'=>'width:16%;'),
            ],

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
