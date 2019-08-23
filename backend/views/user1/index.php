<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\User1;
/* @var $this yii\web\View */
/* @var $searchModel common\models\User1Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '馆员配置';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user1-index">

    <p>
        <?= Html::a('新增馆员', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'table-responsive'],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'id',
                'headerOptions' => array('style'=>'width:5%;'),
            ],

            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            //'status',
            //'created_at',
            //'updated_at',
            //'verification_token',
            'mobile',
            //'library_id',

            [
                'attribute' => 'library_id',
                'label' => '分配至图书馆',
                // 'value'=>function ($model, $key, $index, $column) {
                //     $user = User1::findOne(['id' => Yii::$app->user->id]);
                //     return $user->libraryModel->title;
                // },
                'filter'=> User1::getLibraryOption(),
                //'headerOptions' => array('style'=>'width:120px;'),
            ],
            //'pid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'layout'=>"{items}\n{summary}{pager}",
    ]); ?>


</div>
