<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CallNumberRules */

$this->title = '新增索书号规则';
$this->params['breadcrumbs'][] = ['label' => '索书号管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="call-number-rules-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
