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
        &nbsp;&nbsp;
        <?= Html::a('批量借出', ['mborrow'], ['class' => 'btn btn-success btn-lg', 'data-toggle' => 'modal',  'data-target' => '.bs-example-modal1']) ?>
        &nbsp;&nbsp;
        <?= Html::a('批量还回', ['mreturn'], ['class' => 'btn btn-primary btn-lg', 'data-toggle' => 'modal',  'data-target' => '.bs-example-modal2']) ?>
       
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



<!-- 批量借出弹出窗口 -->
<div class="modal fade bs-example-modal1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="mborrow">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">流通批量借出</h4>
            </div>
            <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="form-group field-reader-card_id">
                            <label class="control-label" for="reader-card_id">读者证号</label>
                            <input type="text" id="card_id" class="form-control" name="modal-card_id" maxlength="32" placeholder="">
                            </div>
                        
                            <div class="form-group field-reader-bar_code_file">
                            <label class="control-label" for="reader-bar_code_file">条码号文件</label>
                            <input type="file" id="bar_code_file1" class="form-control" name="modal-bar_code_file">
                            </div>

                            <div class="alert alert-warning" role="alert">
                                <i class='fa fa-exclamation-triangle'></i>&nbsp;请上传只含有条码号的txt文件，一行一个条码。
                            </div>
                        </div>

                    </div>

                </div><!-- endof modal-body-->

            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left" id="btn_mborrow">确定</button>
            </div>
        </div><!-- endof modal-content-->
        </div>
    </div>
</div>

<!-- 批量还回弹出窗口 -->
<div class="modal fade bs-example-modal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="mreturn">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">流通批量还回</h4>
            </div>
            <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                        
                            <div class="form-group field-reader-bar_code_file">
                            <label class="control-label" for="reader-bar_code_file">条码号文件</label>
                            <input type="file" id="bar_code_file2" class="form-control" name="modal-bar_code_file">
                            </div>

                            <div class="alert alert-warning" role="alert">
                                <i class='fa fa-exclamation-triangle'></i>&nbsp;请上传只含有条码号的txt文件，一行一个条码。
                            </div>
                        </div>

                    </div>

                </div><!-- endof modal-body-->

            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left" id="btn_mborrow">确定</button>
            </div>
        </div><!-- endof modal-content-->
        </div>
    </div>
</div>

<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
            
    });//end of document ready
</script>