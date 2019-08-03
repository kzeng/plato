<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CirculationTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '流通类型';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="circulation-type-index">

    <!-- <p>
        <//?= Html::a('新增流通类型', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <p>
        <?= Html::button('新增流通类型', ['value' =>  Url::toRoute(['circulation-type/create']), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
    </p>

    <?php
        Modal::begin([
            'header' => '<h4>新增流通类型</h4>',
            'id' => 'modal',
            'size' => 'modal-md',
        ]);

        echo "<div id='modalContent'></div>";
        Modal::end();
    ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'table-responsive'],
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

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
        'layout'=>"{items}\n{summary}{pager}",
    ]); ?>

</div>

<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    //alert('ready');
    $('#modalButton').click(function(){
        $('#modal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
    });
})
</script>