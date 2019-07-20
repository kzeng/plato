<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\BorrowReturnBooks;
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
        <button class="btn btn-success" id="query">查询</button>
    </p>

    <h4>读者信息</h4>
    <table class="table table-bordered">
        <tr>
            <th width="15%">姓名</th>
            <td width="10%" id="reader_name"></td>
            <th width="15%">卡号</th>
            <td width="10%" id="card_number"></td>
            <th width="15%">证件状态</th>
            <td width="10%" id="card_status"></td>
            <th width="15%">最大可借数(本)</th>
            <td width="10%" id="max_borrowing_number"></td>
        </tr>

        <tr>
            <th>读者类型</th>
            <td id="reader_type_id"></td>
            <th>性别</th>
            <td id="gender"></td>
            <th>有效期限</th>
            <td id="validity"></td>
            <th>当前借阅数(本)</th>
            <td>0</td>
        </tr>

        <tr>
            <th>押金(元)</th>
            <td id="deposit"></td>
            <th>最大欠款额度(元)</th>
            <td id="max_debt_limit"></td>
            <th>欠费金额(元)</th>
            <td id="creditmoney"></td>
            <th>电话</th>
            <td id="mobile"></td>
        </tr>
    </table>


    <div class="panel panel-default">
        <div class="panel-heading">当前在借书籍 <span class="label label-info borrow_book_count"></span></div>
        <div class="panel-body">
            <table class="table table-striped ">
                <tr>
                    <th>条码号</th>
                    <th>题名</th>
                    <!-- <th>责任者</th> -->
                    <th>ISBN</th>
                    <th>出版社</th>
                    <th>索书号</th>
                    <th>馆藏地</th>
                    <th>借书时间</th>
                    <th>经办人</th>
                    <th>应还时间</th>
                </tr>

                <tbody id='booksinfo'>
                </tbody>

            </table>
        </div>
    </div>

</div>


<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        function queryReaderInfoAndBookinfo() {
            var cardnumber_or_barcode = $("#cardnumber_or_barcode").val();
            // alert(ardnumber_or_barcode);
            var args = {
                'classname': '\\common\\models\\BorrowReturnBooks',
                'funcname': 'getReaderInfoAjax',
                'params': {
                    //'id': '<//?= $model->id ?>',
                    'cardnumber_or_barcode': cardnumber_or_barcode,
                }
            };
            $.ajax({
                url: "<?= \yii\helpers\Url::to(['site/siteajax'], true); ?>",
                type: "GET",
                cache: false,
                dataType: "json",
                data: "args=" + JSON.stringify(args),
                success: function(ret) {
                    if (0 === ret['code']) {
                        //bind data to page
                        $("#reader_name").html(ret['reader_info']['reader_name']);
                        $("#card_number").html(ret['reader_info']['card_number']);
                        $("#card_status").html(ret['reader_info']['card_status']);
                        $("#reader_type_id").html(ret['reader_info']['reader_type_id']);
                        $("#validity").html(ret['reader_info']['validity']);
                        $("#gender").html(ret['reader_info']['gender']);
                        $("#deposit").html(ret['reader_info']['deposit']);
                        $("#creditmoney").html(ret['reader_info']['creditmoney']);
                        $("#mobile").html(ret['reader_info']['mobile']);
                        $("#max_borrowing_number").html(ret['reader_info']['max_borrowing_number']);
                        $("#max_debt_limit").html(ret['reader_info']['max_debt_limit']);
                        //now, get current borrowing books info
                        var html_tr = '';
                        var args = {
                            'classname': '\\common\\models\\BorrowReturnBooks',
                            'funcname': 'getBooksInfoAjax',
                            'params': {
                                'cardnumber': ret['reader_info']['card_number'],
                            }
                        };
                        $.ajax({
                            url: "<?= \yii\helpers\Url::to(['site/siteajax'], true); ?>",
                            type: "GET",
                            cache: false,
                            dataType: "json",
                            data: "args=" + JSON.stringify(args),
                            success: function(ret) {
                                if (0 === ret['code']) {
                                    //bind data to page
                                    // $("#reader_name").html(ret['reader_info']['reader_name']);
                                    $(".borrow_book_count").html(ret['borrow_return_books']['count']);
                                    for (i = 0; i < ret['borrow_return_books']['info'].length; i++) {
                                        //alert(ret['borrow_return_books'][i]['bar_code']);
                                        // <th>条码号</th>
                                        // <th>题名</th>
                                        // <th>责任者</th>
                                        // <th>ISBN</th>
                                        // <th>出版社</th>
                                        // <th>索书号</th>
                                        // <th>馆藏地</th>
                                        // <th>借书时间</th>
                                        // <th>经办人</th>
                                        // <th>应还时间</th>
                                        // 'bar_code' => $brb->bar_code,
                                        // 'created_at' => date('Y-m-d', $brb->created_at),
                                        // 'title' => $book->title,
                                        // 'isbn'  => $book->isbn,
                                        // 'publisher'  => $book->publisher,
                                        // 'call_number'  => $book->call_number,
                                        // 'collection_place' => $collection_place->title,
                                        console.log("------------------");
                                        console.log(ret['borrow_return_books']['info'][i]);
                                        html_tr += "<tr>";
                                        html_tr += "<td>" + ret['borrow_return_books']['info'][i]["bar_code"] + "</td>";
                                        html_tr += "<td>" + ret['borrow_return_books']['info'][i]["title"] + "</td>";
                                        html_tr += "<td>" + ret['borrow_return_books']['info'][i]["isbn"] + "</td>";
                                        html_tr += "<td>" + ret['borrow_return_books']['info'][i]["publisher"] + "</td>";
                                        html_tr += "<td>" + ret['borrow_return_books']['info'][i]["call_number"] + "</td>";
                                        html_tr += "<td>" + ret['borrow_return_books']['info'][i]["collection_place"] + "</td>";
                                        html_tr += "<td>" + ret['borrow_return_books']['info'][i]["created_at"] + "</td>";
                                        html_tr += "<td>" + ret['borrow_return_books']['info'][i]["operator"] + "</td>";
                                        html_tr += "<td>-</td>";
                                        html_tr += "</tr>";
                                        //alert(html_tr);
                                        $("#booksinfo").html(html_tr);
                                    }
                                } else {
                                    alert("Get bookinfo error");
                                }
                            },
                            error: function() {
                                alert('Get bookinfo 发送失败。');
                            }
                        }); //end of get current borrowing books info
                    } else {
                        alert("error");
                    }
                },
                error: function() {
                    alert('发送失败。');
                }
            });
        }
        $('#cardnumber_or_barcode').bind('keydown', function(event) {
            if (event.keyCode == "13") {
                queryReaderInfoAndBookinfo();
            }
        });
        $('#query').click(function() {
            queryReaderInfoAndBookinfo();
        });
    }); //end of document ready
</script>