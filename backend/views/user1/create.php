<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User1 */

$this->title = '新增用户';
$this->params['breadcrumbs'][] = ['label' => '用户', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user1-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
