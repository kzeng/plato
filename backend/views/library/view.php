<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Library;
use common\models\User1;

/* @var $this yii\web\View */
/* @var $model common\models\Library */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => '图书馆', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="library-view">

    <!-- <h1><//?= Html::encode($this->title) ?></h1> -->

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
            'mobile',
            'address',
            'user_id',
            'created_at:datetime',
            'updated_at:datetime',
                        
            //'status',
            //'pid',
        ],
    ]) ?>

</div>
