<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LibrarySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '图书馆配置';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="library-index">

    <!-- <h1><//?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('新增', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'mobile',
            'address',
            //'user_id',
            //'created_by',
            //'updated_by',
            //'status',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
