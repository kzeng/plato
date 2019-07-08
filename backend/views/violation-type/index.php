<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ViolationTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '违章类型管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="violation-type-index">

    <p>
        <?= Html::a('新增违章类型', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'table-responsive'],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description',
            // 'library_id',
            // 'user_id',
            //'created_at',
            //'updated_at',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
