<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\models\Reader;
use common\models\Library;
use common\models\User1;


/* @var $this yii\web\View */
/* @var $model common\models\Reader */

//$this->title = $model->id;
$this->title = "读者信息";
$this->params['breadcrumbs'][] = ['label' => '读者', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reader-view">
    
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
        <button type="button" class="btn btn-danger" id="gs">挂失</button>
        <button type="button" class="btn btn-success" id="jcgs">解除挂失</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">换证</button>
        <button type="button" class="btn btn-primary" id="jnyfj">缴纳预付款</button>
        <button type="button" class="btn btn-danger" id="zjzx">证件注销</button>
        </span>
    </p>

    <!-- 最大可借数(本)	8	当前借阅数(本) -->

    <?= DetailView::widget([
        'model' => $model,
        //'options' => ['class' => 'table table-striped table-bordered detail-view'],    
        //'template' => '<tr><th style="width: 160px;">{label}</th><td>{value}</td></tr>', 
        'attributes' => [
            'id',
            'card_number',
            //'card_status',
            [
                'label' => '证件状态',
                'value' => $model->getCardStatus($model),
                'format'=> 'html',
            ],
            'reader_name',
            'validity:datetime',

            'id_card',
            //'reader_type_id',
            [
                'label' => '读者类型',
                'value' => Reader::getReaderType($model),
                'format'=> 'html',
            ],
            
            //'gender',
            [
                'label' => '性别',
                'value' => $model->getGender($model),
                'format'=> 'html',
            ],
            
            'deposit',
            'creditmoney',
            'mobile',
            'address',
            // 'library_id',
            // 'user_id',
            // [
            //     'label' => '图书馆ID',
            //     'value' => Library::getLibraryTitle($model),
            //     'format'=> 'html',
            // ],
            // [
            //     'label' => '操作员ID',
            //     'value' => User1::getUser1Username($model),
            //     'format'=> 'html',
            // ],

            // 'created_at:datetime',
            // 'updated_at:datetime',
            //'status',
        ],
    ]) ?>

</div>

<!-- 换证弹出窗口 -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="hzModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="gridSystemModalLabel">换证</h4>
            </div>
            <div class="modal-body">

                <div class="form-group field-reader-card_number">
                    <input type="text" id="modal-card_number" class="form-control" name="modal-card_number" maxlength="32" placeholder="读者证卡号">
                    <div class="help-block"></div>
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
                'classname':    '\\common\\models\\Reader',
                'funcname':     'setCardStatusAjax',
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
                        alert("证件已经成功挂失！");
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

        $('#jcgs').click (function () {
            var args = {
                'classname':    '\\common\\models\\Reader',
                'funcname':     'setCardStatusAjax',
                'params':       {
                    'id': '<?= $model->id ?>',
                    'card_status': 1,
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
                        alert("证件已经成功解除挂失！");
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

        $('#hz').click (function () {
            var args = {
                'classname':    '\\common\\models\\Reader',
                'funcname':     'setCardNumberAjax',
                'params':       {
                    'id': '<?= $model->id ?>',
                    'card_number': $('#modal-card_number').val(),
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
                        alert("证件已经成功换号！");
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