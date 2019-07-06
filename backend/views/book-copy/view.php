<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BookCopy */

//$this->title = $model->title;
$this->title = "图书副本信息";
$this->params['breadcrumbs'][] = ['label' => '图书副本', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="book-copy-view">

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
            'bar_code',
            //'bookseller_id',
            'bookseller.title',
            'price1',
            'price2',
            //'collection_place_id',
            'collectionPlace.title',

            //'circulation_type_id',
            'circulationType.title',
            
            'call_number_rules_id',
            // 'library_id',
            // 'user_id',
            // 'created_at:datetime',
            // 'updated_at:datetime',
            //'status',
        ],
    ]) ?>

</div>
