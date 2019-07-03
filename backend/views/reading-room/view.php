<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ReadingRoom */

//$this->title = $model->title;
$this->title = "阅览室信息";
$this->params['breadcrumbs'][] = ['label' => '阅览室', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reading-room-view">

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '删除本条信息，确定?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description',
            // 'library_id',
            // 'user_id',
            // 'created_at:datetime',
            // 'updated_at:datetime',
            //'status',
        ],
    ]) ?>


    <div class="reading-room-form">
            <div class="form-group field-readingroom-card_number">
                <label class="control-label" for="readingroom-card_number">读者证号</label>
                <input type="text" id="readingroom-card_number" class="form-control" maxlength="64">

                <div class="help-block"></div>
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-lg" id="checkin">
                    <i class="fa fa-calendar-check-o"></i> 签到
                </button>

                <a  class="btn btn-primary btn-lg pull-right" href="<?= Yii::$app->request->getHostInfo() ?>/reading-room-checkin?ReadingRoomCheckinSearch[reading_room_id]=<?= $model->id ?>&sort=-id">
                <i class="fa fa-eye"></i> 浏览阅览室签到表
                </a>

            </div>
    </div>

</div>



<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function() {

        $('#checkin').click (function () {
            // alert('confirmAjax');
            // if (!confirm("确定要发布吗?"))
            //     return;
            var args = {
                'classname':    '\\common\\models\\ReadingRoom',
                'funcname':     'setCheckinAjax',
                'params':       {
                    'card_number': $("#readingroom-card_number").val(),
                    'library_id': '<?= $model->library_id ?>',
                    'reading_room_id': '<?= $model->id ?>',
                    'user_id': '<?= $model->user_id ?>',
                }
            };
            $.ajax({
                url:        "<?= \yii\helpers\Url::to(['site/siteajax'], true) ; ?>",
                type:       "GET",
                cache:      false,
                dataType:   "json",
                data:       "args=" + JSON.stringify(args),
                success:    function(ret) { 
                    if (0 === ret['code']) 
                    {
                        alert("签到成功！");
                        //location.href = '<//?= Url::to() ?>';
                        $("#readingroom-card_number").val('');
                        $("#readingroom-card_number").focus();

                    }
                    else
                    {
                        alert("error");
                    }
                },                        
                error:      function(){
                    alert('发送失败。');
                }
            });
        });

            
    });//end of document ready
</script>