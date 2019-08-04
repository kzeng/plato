<?php

/* @var $this yii\web\View */
/* @var $model common\models\Events */

$this->title = '新增事件';
$this->params['breadcrumbs'][] = ['label' => '事件', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="events-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
