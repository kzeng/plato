<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '图书管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <p>
        <?= Html::a('新增图书', ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::a('<i class="fa fa-download"></i> 导出图书信息', ['export'], ['class' => 'btn btn-danger']) ?>
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
            //'cover_img',
            // [
            //     'attribute' => 'cover_img',
            //     'value' => function($model){
            //         if($model->cover_img == '')
            //             return "<img width=60 src='holder.js/60x90'>";
            //         else
            //             return "<img width=60 src='".$model->cover_img."'>";
            //     },
            //     'format' => 'html',
            //     'headerOptions' => array('style'=>'width:10%;'),
            // ],
            'title',
            'isbn',
            'author',
            //'price',
            //'class_number',
            //'call_number',
            'publisher',
            //'publication_place',
            [
                'attribute' => 'publish_date',
                'headerOptions' => array('style'=>'width:10%;'),
            ],
            [
                'attribute' => 'copy_number',
                'headerOptions' => array('style'=>'width:8%;'),
            ],
            //'series_title',
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
