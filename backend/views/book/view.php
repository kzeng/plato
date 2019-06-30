<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

use common\models\Book;

/* @var $this yii\web\View */
/* @var $model common\models\Book */

// $this->title = $model->title;
$this->title = "图书信息";

$this->params['breadcrumbs'][] = ['label' => '图书', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="book-view">

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '删除本条记录，确定?',
                'method' => 'post',
            ],
        ]) ?>


        <span class="pull-right">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal">添加副本</button>
        </span>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'isbn',
            'author',
            'price',
            'class_number',
            'call_number',
            'copy_number',
            'publisher',
            'publication_place',
            'publish_date',
            'series_title',
            // 'library_id',
            // 'user_id',
            // 'created_at:datetime',
            // 'updated_at:datetime',
            //'status',
        ],
    ]) ?>

</div>


<!-- 换证弹出窗口 -->
<div class="modal fade bs-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="tjfbModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">添加副本, 图书ID:<?= $model->id ?></h4>
            </div>
            <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            
                            <div class="form-group field-reader-copy_number">
                            <label class="control-label" for="reader-copy_number">添加副本数</label>
                            <input type="text" id="copy_number" class="form-control" name="modal-copy_number" maxlength="32" placeholder="">
                            <div class="help-block"></div>
                            </div>
                            
                            <div class="form-group field-reader-bar_code">
                            <label class="control-label" for="reader-bar_code">条形码</label>
                            <input type="text" id="bar_code" class="form-control" name="modal-bar_code" maxlength="32" placeholder="">
                            <div class="help-block"></div>
                            </div>

                            <div class="form-group field-reader-price1">
                            <label class="control-label" for="reader-price1">实码(元)</label>
                            <input type="text" id="price1" class="form-control" name="modal-price1" maxlength="32" placeholder="">
                            <div class="help-block"></div>
                            </div>

                            <div class="form-group field-reader-price2">
                            <label class="control-label" for="reader-price2">洋码(元)</label>
                            <input type="text" id="price2" class="form-control" name="modal-price2" maxlength="32" placeholder="">
                            <div class="help-block"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group field-reader-card_status">
                            <label class="control-label" for="reader-card_status">馆藏地点</label>
                            <!-- #collect_place -->
                            <?php echo Book::getCollectionPlace($model->id) ?>
                            <div class="help-block"></div>
                            </div>

                            <div class="form-group field-reader-card_status">
                            <label class="control-label" for="reader-card_status">流通类型</label>
                            <!-- #circulation_type -->
                            <?php echo Book::getCirculationType($model->id) ?>
                            <div class="help-block"></div>
                            </div>
                            
                            <div class="form-group field-reader-card_status">
                            <label class="control-label" for="reader-card_status">书商</label>
                            <!-- #bookseller -->
                            <?php echo Book::getBookseller($model->id) ?>
                            <div class="help-block"></div>
                            </div>

                            <div class="form-group field-reader-call_number">
                            <label class="control-label" for="reader-call_number">索书号</label>
                            <input type="text" id="call_number" class="form-control" name="modal-call_number" maxlength="32" placeholder="">
                            <div class="help-block"></div>
                            </div>
                        </div>

                    </div>

                </div><!-- endof modal-body-->

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="hz">确定</button>
            </div>
        </div><!-- endof modal-content-->
        </div>
    </div>
</div>



<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function() {

        $('#gs').click (function () {
            // alert('confirmAjax');
            // if (!confirm("确定要发布吗?"))
            //     return;
            var args = {
                'classname':    '\\common\\models\\Book',
                'funcname':     'setAddBookCopyAjax',
                'params':       {
                    'id': '<?= $model->id ?>',
                    'card_status': 0,
                }
            };
            $.ajax({
                url:        "<?= \yii\helpers\Url::to(['site/siteajax'], true) ; ?>",
                type:       "GET",
                cache:      false,
                dataType:   "json",
                data:       "args=" + JSON.stringify(args),
                success:    function(ret) { 
                    if (0 === ret['code']) 
                    {
                        alert("已成功新增复本");
                        location.href = '<?= Url::to() ?>';
                    } 
                    else
                    {
                            alert("error");
                    }
                },                        
                error:      function(){
                    alert('发送失败。');
                }
            });
        });




            
    });//end of document ready
</script>