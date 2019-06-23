<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReaderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '读者管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reader-index">

    <p>
        <?= Html::a('新增读者', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           //['class' => 'yii\grid\SerialColumn'],

            'id',
            'card_number',
            'card_status',
            'reader_name',
            'validity',
            'id_card',
            'reader_type_id',
            'gender',
            //'deposit',
            //'mobile',
            //'address',
            //'library_id',
            //'user_id',
            //'created_at',
            //'updated_at',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
