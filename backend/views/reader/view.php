<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Reader;
use common\models\Library;
use common\models\User1;


/* @var $this yii\web\View */
/* @var $model common\models\Reader */

//$this->title = $model->id;
$this->title = "读者信息";
$this->params['breadcrumbs'][] = ['label' => '读者', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reader-view">

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '删除本条记录，确定?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'card_number',
            //'card_status',
            [
                'label' => '证件状态',
                'value' => $model->getCardStatus($model),
                'format'=> 'html',
            ],
            'reader_name',
            'validity:datetime',

            'id_card',
            //'reader_type_id',
            [
                'label' => '读者类型',
                'value' => Reader::getReaderType($model),
                'format'=> 'html',
            ],
            
            //'gender',
            [
                'label' => '性别',
                'value' => $model->getGender($model),
                'format'=> 'html',
            ],
            
            'deposit',
            'mobile',
            'address',
            // 'library_id',
            // 'user_id',
            [
                'label' => '图书馆ID',
                'value' => Library::getLibraryTitle($model),
                'format'=> 'html',
            ],
            [
                'label' => '操作员ID',
                'value' => User1::getUser1Username($model),
                'format'=> 'html',
            ],

            'created_at:datetime',
            'updated_at:datetime',
            //'status',
        ],
    ]) ?>

</div>
