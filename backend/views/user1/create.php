<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User1 */

$this->title = '新增馆员';
$this->params['breadcrumbs'][] = ['label' => '馆员', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user1-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
