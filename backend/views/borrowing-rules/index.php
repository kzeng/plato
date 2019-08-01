<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BorrowingRulesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '借阅规则配置';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borrowing-rules-index">

    <p>
        <?= Html::a('新增借阅规则', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'table-responsive'],
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'headerOptions' => array('style'=>'width:10%;'),
            ],
            'title',
            'general_loan_period',
            'extended_period_impunity',
            'first_term_of_punishment',

            //'first_penalty_unit_price',
            //'other__unit_price',
            [
                'format' => 'html',
                'label' => '读者类型',
                'attribute' => 'readerTypes',
                'headerOptions' => array('style'=>'width:10%;'),
            ],
            [
                'format' => 'html',
                'label' => '流通类型',
                'attribute' => 'circulationTypes',
                'headerOptions' => array('style'=>'width:10%;'),
            ],
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
        'layout'=>"{items}\n{summary}{pager}",
    ]); ?>


</div>
