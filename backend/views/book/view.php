<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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
                <h4 class="modal-title" id="gridSystemModalLabel">添加副本</h4>
            </div>
            <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            
                            <div class="form-group field-reader-card_status">
                            <label class="control-label" for="reader-card_status">添加副本数</label>
                            <input type="text" id="modal-card_number" class="form-control" name="modal-card_number" maxlength="32" placeholder="">
                            <div class="help-block"></div>
                            </div>
                            
                            <div class="form-group field-reader-card_status">
                            <label class="control-label" for="reader-card_status">条形码</label>
                            <input type="text" id="modal-card_number" class="form-control" name="modal-card_number" maxlength="32" placeholder="">
                            <div class="help-block"></div>
                            </div>

                            <div class="form-group field-reader-card_status">
                            <label class="control-label" for="reader-card_status">实码</label>
                            <input type="text" id="modal-card_number" class="form-control" name="modal-card_number" maxlength="32" placeholder="">
                            <div class="help-block"></div>
                            </div>

                            <div class="form-group field-reader-card_status">
                            <label class="control-label" for="reader-card_status">洋码</label>
                            <input type="text" id="modal-card_number" class="form-control" name="modal-card_number" maxlength="32" placeholder="">
                            <div class="help-block"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group field-reader-card_status">
                            <label class="control-label" for="reader-card_status">馆藏地点</label>
                            <select id="reader-card_status" class="form-control" name="Reader[card_status]">
                            <option value="1">正常</option>
                            <option value="0">挂失</option>
                            </select>
                            <div class="help-block"></div>
                            </div>

                            <div class="form-group field-reader-card_status">
                            <label class="control-label" for="reader-card_status">流通类型</label>
                            <select id="reader-card_status" class="form-control" name="Reader[card_status]">
                            <option value="1">正常</option>
                            <option value="0">挂失</option>
                            </select>
                            <div class="help-block"></div>
                            </div>
                            
                            <div class="form-group field-reader-card_status">
                            <label class="control-label" for="reader-card_status">书商</label>
                            <select id="reader-card_status" class="form-control" name="Reader[card_status]">
                            <option value="1">正常</option>
                            <option value="0">挂失</option>
                            </select>
                            <div class="help-block"></div>
                            </div>

                            <div class="form-group field-reader-card_status">
                            <label class="control-label" for="reader-card_status">索书号</label>
                            <input type="text" id="modal-card_number" class="form-control" name="modal-card_number" maxlength="32" placeholder="">
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
