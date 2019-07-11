<?php

use yii\helpers\Html;
use yii\grid\GridView;

use common\models\Reader;

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
        'options' => ['class' => 'table-responsive'],
        'columns' => [
           //['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'headerOptions' => array('style'=>'width:5%;'),
            ],
 
            [
                'attribute' => 'reader_name',
                'headerOptions' => array('style'=>'width:8%;'),
            ],
            'card_number',
            //'card_status',
            [
                'attribute' => 'card_status',
                'label' => '证件状态',
                'value'=>function ($model, $key, $index, $column) {
                    //return Reader::getCardStatusOption($model->card_status);
                    return Reader::getCardStatus($model);
                },
                'filter'=> Reader::getCardStatusOption(),
                'headerOptions' => array('style'=>'width:10%;'),
                'format' => 'html'
            ],

            //'validity',
            [
                'attribute' => 'validity',
                'label' => '有效期限',
                'value'=>function ($model, $key, $index, $column) {
                    return Yii::$app->formatter->asDate($model->validity);
                },
                //'filter'=> Reader::getCardStatusOption(),
                'headerOptions' => array('style'=>'width:15%;'),
                'format' => 'html'
            ],

            'id_card',
            //'reader_type_id',
            [
                'attribute' => 'reader_type_id',
                'label' => '读者类型',
                'value'=>function ($model, $key, $index, $column) {
                    return Reader::getReaderTypeOption($model->reader_type_id);
                },
                'filter'=> Reader::getReaderTypeOption(),
                'headerOptions' => array('style'=>'width:10%;'),
            ],
            [
                'attribute' => 'gender',
                'label' => '性别',
                'value'=>function ($model, $key, $index, $column) {
                    return Reader::getGenderOption($model->gender);
                },
                'filter'=> Reader::getGenderOption(),
                'headerOptions' => array('style'=>'width:8%;'),
            ],

            //'deposit',
            //'creditmoney',
            //'mobile',
            //'address',
            //'library_id',
            //'user_id',
            //'created_at',
            //'updated_at',
            // 'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => array('style'=>'width:10%;'),
            ],

        ],
    ]); ?>


</div>
