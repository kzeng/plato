<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ReaderType */

//$this->title = $model->title;
$this->title = "读者类型信息";
$this->params['breadcrumbs'][] = ['label' => '读者类型', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reader-type-view">

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
        'options' => ['class' => 'table table-striped table-bordered detail-view'],    
        'template' => '<tr><th style="width: 30%;">{label}</th><td>{value}</td></tr>', 
        'attributes' => [
            'id',
            'title',
            'max_borrowing_number',
            'max_debt_limit',
            'max_return_time',
            // 'library_id',
            // 'user_id',
            // 'created_at:datetime',
            // 'updated_at:datetime',
            //'status',
        ],
    ]) ?>

</div>
