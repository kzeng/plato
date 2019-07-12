<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BarCodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '条码号序列设置';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bar-code-index">

    <p>
        <?= Html::a('新增', ['create'], ['class' => 'btn btn-success']) ?>
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
            'title',
            'prefix',
            'number_length',
            'min_number',
            'max_number',
            //'description',
            //'library_id',
            //'user_id',
            //'created_at',
            //'updated_at',
            //'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => array('style'=>'width:10%;'),
            ],

        ],
    ]); ?>


</div>
