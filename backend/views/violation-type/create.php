<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ViolationType */

$this->title = '新增违章类型';
$this->params['breadcrumbs'][] = ['label' => '违章类型', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="violation-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
