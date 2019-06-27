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
            'publisher',
            'publication_place',
            'publish_date',
            'series_title',
            'library_id',
            'user_id',
            'created_at:datetime',
            'updated_at:datetime',
            //'status',
        ],
    ]) ?>

</div>
