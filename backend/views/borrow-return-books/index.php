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
        <!-- <//?= Html::a('新增', ['create'], ['class' => 'btn btn-success']) ?> -->

        <?= Html::a('借书', ['borrow'], ['class' => 'btn btn-success btn-lg']) ?>
        &nbsp;&nbsp;
        <?= Html::a('还书', ['return'], ['class' => 'btn btn-primary btn-lg']) ?>
        &nbsp;&nbsp;
        <?= Html::a('续借', ['renew'], ['class' => 'btn btn-warning btn-lg']) ?>
        &nbsp;&nbsp;
        <?= Html::a('丢失', ['loss'], ['class' => 'btn btn-danger btn-lg']) ?>

       
        <?= Html::a('<i class="fa fa-exchange"></i> 流通借还详情', ['detail'], ['class' => 'btn btn-info btn-lg pull-right']) ?>
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
            [
                'label' => '读者姓名',
                'attribute' => 'reader_name',
                'value' => 'reader.reader_name',
                'headerOptions' => array('style'=>'width:10%;'),
            ],
            //reader_id',
            //'card_number',
            [
                'label' => '卡号',
                'attribute' => 'card_number',
                'value' => function($model){
                    return Html::a($model->card_number, ['detail', 'cardnumber_or_barcode' => $model->card_number]);
                },
                'format' => 'html',
            ],

            //'bar_code',
            [
                'label' => '条码号',
                'attribute' => 'bar_code',
                'value' => function($model){
                    return Html::a($model->bar_code, ['detail', 'cardnumber_or_barcode' => $model->bar_code]);
                },
                'format' => 'html',
            ],


            [
                'label' => '书名',
                //'attribute' => 'reader_name',
                'value' => 'bookCopy.book.title',
                'headerOptions' => array('style'=>'width:18%;'),
            ],
            //'operation',

            [
                'attribute' => 'operation',
                'label' => '操作',
                'value'=>function ($model, $key, $index, $column) {
                    //return BorrowReturnBooks::getOperationOption($model->operation);
                    if($model->operation == 1)
                        return "<span class=\"badge label-success\">".BorrowReturnBooks::getOperationOption($model->operation)."</span>";
                    else
                        return "<span class=\"badge label-warning\">".BorrowReturnBooks::getOperationOption($model->operation)."</span>";

                },
                'filter'=> BorrowReturnBooks::getOperationOption(),
                'format' => 'html',
                'headerOptions' => array('style'=>'width:10%;'),
            ],

            //'library_id',
            //'user_id',
            //'created_at:datetime',
            [
                'label' => '借书时间',
                'value' => function($model){
                    return date('Y-m-d', $model->created_at);
                },
                'headerOptions' => array('style'=>'width:10%;'),
            ],

            //'updated_at',
            //'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => array('style'=>'width:8%;'),
            ],

        ],
        //layout内有5个可以使用的值，分别为{summary}、{errors}、{items}、{sorter}和{pager}
        'layout'=>"{items}\n{summary}{pager}",
        // 'rowOptions'=>function($model,$key, $index){
        //     if($index%2 === 0){
        //         return ['style'=>'background:#eee'];
        //     }
        // },

    ]); ?>


</div>
