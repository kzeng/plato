<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BookCopySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '图书副本管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-copy-index">

    <p>
        <?= Html::a('新增图书副本', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'bar_code',
            'bookseller_id',
            'price1',
            //'price2',
            //collection_place_id',
            //'circulation_type_id',
            //'call_number_rules_id',
            //'library_id',
            //'user_id',
            //'created_at',
            //'updated_at',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
