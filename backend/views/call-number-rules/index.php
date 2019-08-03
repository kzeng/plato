<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CallNumberRulesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '索书号管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="call-number-rules-index">

    <p>
        <?= Html::a('新增索书号规则', ['create'], ['class' => 'btn btn-success']) ?>
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
                'headerOptions' => array('style'=>'width:10%;'),
            ],

            [
                'attribute' => 'title',
                'headerOptions' => array('style'=>'width:25%;'),
            ],

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
            //'library_id',
            //'user_id',
            //'created_at',
            //'updated_at',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'layout'=>"{items}\n{summary}{pager}",
    ]); ?>


</div>
