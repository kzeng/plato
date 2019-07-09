<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BorrowReturnBooks */

// $this->title = $model->id;
$this->title = '流通借还详情';
$this->params['breadcrumbs'][] = ['label' => '借还书管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="borrow-return-books-detail">
<p>
    <input type="text" style="width:300px" class="form-control pull-left" id="cardnumber_or_barcode" placeholder="请刷读者卡或者书籍条码">
    &nbsp;
    <button class="btn btn-success">查询</button>
</p>

<div class="panel panel-default">
  <div class="panel-heading">读者信息</div>
  <div class="panel-body">
    <table class="table table-bordered">
    <tr>
        <th>姓名</th>
        <td>黄艳艳</td>
        <th>卡号</th>
        <td>4049</td>
        <th>证件状态</th>
        <td>正常</td>
        <th>最大可借数(本)</th>
        <td>8</td>
    </tr>
            
    <tr>
        <th>读者类型</th>
        <td>在校学生</td>
        <th>性别</th>
        <td>女</td>
        <th>有效期限</th>
        <td>2021/07/31</td>
        <th>当前借阅数(本)</th>
        <td>0</td>
    </tr>

    <tr>
        <th>押金(元)</th>
        <td>100</td>
        <th>最大欠款额度(元)</th>
        <td>3</td>
        <th>欠费金额(元)</th>
        <td>0</td>
        <th></th>
        <td></td>
    </tr>
    </table>
  </div>
</div>


<div class="panel panel-default">
  <div class="panel-heading">当前在借书籍 <span class="label label-info">4</span></div>
  <div class="panel-body">
    <table class="table table-striped ">
    <tr>
    <th>条码号</th>
    <th>题名</th>
    <th>责任者</th>
    <th>ISBN</th>
    <th>出版社</th>
    <th>索书号</th>
    <th>馆藏地</th>
    <th>借书时间</th>
    <th>经办人</th>
    <th>应还时间</th>
    </tr>

    <tr>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>

    <tr>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>

    <tr>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>

    <tr>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
    </table>
</div>
</div>



</div>
