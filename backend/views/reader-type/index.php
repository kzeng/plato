<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReaderTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '读者类型管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reader-type-index">

    <p>
        <?= Html::a('新增读者类型', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'table-responsive'],
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'max_borrowing_number',
            'max_debt_limit',
            //'library_id',
            //'user_id',
            //'created_at',
            //'updated_at',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
