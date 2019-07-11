<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CallNumberRules */

// $this->title = $model->title;
$this->title = "索书号信息";
$this->params['breadcrumbs'][] = ['label' => '索书号管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="call-number-rules-view">

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
        // 'encodeLabels' => false,
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'format' => 'html',
                'label' => '馆藏地点',
                'attribute' => 'collectionPlaces',
            ],
            [
                'format' => 'html',
                'label' => '流通类型',
                'attribute' => 'circulationTypes',
            ],
            // 'library_id',
            // 'user_id',
            // 'created_at',
            // 'updated_at',
            // 'status',
        ],
    ]) ?>

</div>
