<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'card_number',
            'card_status',
            'reader_name',
            'validity',
            'id_card',
            'reader_type_id',
            'gender',
            'deposit',
            'mobile',
            'address',
            'library_id',
            'user_id',
            'created_at:datetime',
            'updated_at:datetime',
            //'status',
        ],
    ]) ?>

</div>
