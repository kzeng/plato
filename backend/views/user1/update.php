<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User1 */

$this->title = '馆员管理: ' . $model->id;

$this->params['breadcrumbs'][] = ['label' => '馆员管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="user1-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
