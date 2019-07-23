# 开发阶段日志


## 常用组件使用笔记

### 后台图片管理组件

`https://github.com/noam148/yii2-image-manager` （不支持多图上传?）
缩略图模式[inset, outbound],
inset 保证内容，       模式为保证缩略图像内容的完整不会严格按照给定尺寸裁剪，
outbound 保证尺寸,      会先进行缩放，再按照尺寸裁剪， 所以可以保证尺寸的准确，但图像内容可能会有所损失；

1. 配置文件中设置好, 注意对应的目录要设成可写, 用于在别的地方显示图片(根据id显示图片)

```
'components' => [
    'imagemanager' => [
        'class' => 'noam148\imagemanager\components\ImageManagerGetPath',
        //set media path (outside the web folder is possible)
        // 'mediaPath' => '/path/where/to/store/images/media/imagemanager', 
        // 原始文件存放路径
        'mediaPath' => Yii::getAlias('@storage/web/img'),        
        // path relative web folder to store the cache images
        // 在使用图片时，会从cache目录读，如果cache目录内没有，就从原始文件生成。cache目录应当是web可访问的目录，如当backend用时就是cache目录就相对于backend/web下, 当frontend用时, cache目录就相对于frontend/web目录下
        //'cachePath' => 'assets/images',
        'cachePath' => 'image-cache',
        //use filename (seo friendly) for resized images else use a hash
        'useFilename' => true,
        //show full url (for example in case of a API)
        'absoluteUrl' => true,
    ],
    ...
],
```

// 通过一个url地址，可以后台管理图片库

```
'modules' => [            
    'imagemanager' => [
        'class' => 'noam148\imagemanager\Module',
        //set accces rules ()
        'canUploadImage' => true,
        'canRemoveImage' => function(){
            return true;
        },
        // Set if blameable behavior is used, if it is, callable function can also be used
        'setBlameableBehavior' => true,
        //add css files (to use in media manage selector iframe)
        'cssFiles' => [
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css',
        ],
    ],
    ...
],
```

1. 在视图文件中, 使用如下
<?php echo $form->field($model, 'qr_image_id')->widget(\noam148\imagemanager\components\ImageManagerInputWidget::className(), [
    'cropViewMode' => 1,
    'aspectRatio' => 1,   // (16/9), (4/3) (1024/768)   裁剪比, 1表示正方形
    'showPreview' => true,
    'showDeletePickedImageConfirm' => false, //on true show warning before detach image
]); ?>


$imgUrl = \Yii::$app->imagemanager->getImagePath($this->qr_image_id, 9999, 9999); // 9999表示size， 要多大就多动裁剪多大，并不是上传时预先裁的


3.初次安装时执行
php yii migrate --migrationPath=@noam148/imagemanager/migrations

-------------------------------------------------------------------------------------------

### 制图表组件highcharts

https://github.com/2amigos/yii2-highcharts-widget
另一个是 https://github.com/2amigos/yii2-chartjs-widget

view文件中
<?php echo \dosamigos\highcharts\HighCharts::widget([
    'clientOptions' => [
        'chart' => [
                'type' => 'bar'
        ],
        'title' => [
             'text' => 'Fruit Consumption'
             ],
        'xAxis' => [
            'categories' => [
                'Apples',
                'Bananas',
                'Oranges'
            ]
        ],
        'yAxis' => [
            'title' => [
                'text' => 'Fruit eaten'
            ]
        ],
        'series' => [
            ['name' => 'Jane', 'data' => [1, 0, 4]],
            ['name' => 'John', 'data' => [5, 7, 3]]
        ]
    ]
]); ?>


### 富文本编辑组件tinyMCE
`https://github.com/2amigos/yii2-tinymce-widget`

view文件中，使用如下
```
<?php echo $form->field($model, 'sms_template')->widget(\dosamigos\tinymce\TinyMce::className(), [
    'options' => ['rows' => 6],
    'language' => 'zh_CN',
    'clientOptions' => [
        'relative_urls' => false,
        'remove_script_host' => false,
        'convert_urls' => true,
        'file_browser_callback' => new yii\web\JsExpression("function(field_name, url, type, win) {
            window.open('".yii\helpers\Url::to(['/imagemanager/manager', 'view-mode'=>'iframe', 'select-type'=>'tinymce'])."&tag_name='+field_name,'','width=800,height=540 ,toolbar=no,status=no,menubar=no,scrollbars=no,resizable=no');
        }"),
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste image"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ]
])->label(false); ?>   
```

在ajax reload page时可能会初始化不了，改一下TinyMce.php, 见http://127.0.0.1/huanping/backend/web/index.php?r=b_1_5
$js[] = "tinymce.remove(); tinymce.init($options);"; // hbhe


### 多级联动 
`https://github.com/kartik-v/dependent-dropdown```
1. 在view文件form中
```
<?php echo $form->field($model, 'brand_id')->dropDownList(\yii\helpers\ArrayHelper::map(
    \common\models\WxBrand::find()->where(['client_id' => $gh->client_id])->orderBy('sort_order desc')->all(),
    'id',
    'name'
), ['prompt'=>'选择品牌...', 'id'=>'brand_id'])->label('品牌'); ?>

<?php echo $form->field($model, 'model_id')->label('型号')->widget(\kartik\depdrop\DepDrop::classname(), [
     'options' => ['id' => 'model_id', 'class'=>'', 'style'=>''],
     'pluginOptions'=>[
         'depends'=>['brand_id'],
         'placeholder' => '机型...',
         'initialize' => $model->isNewRecord ? false : true,
         'url' => Url::to(['/sj-policy/model-subcat']),                     
     ]
 ]); ?>
```

2. 在controll中，
当下拉框change时对应的动作, 注意返回的json(字段必须是'id', 'name')
```
[
    0 => ['id' => 1, 'name' => 'SONY-1'],
    1 => ['id' => 2, 'name' => 'SONY-2'],
    ...
]
public function actionModelSubcat() 
{
    $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if ($parents != null) {
            $parent_id = $parents[0];
            //$out = \common\models\SjPhoneModel::find()->select(['id', 'name'])->where(['brand_id' => $parent_id])->orderBy(['sort_order' => SORT_DESC])->asArray()->all(); 
            $out = \common\models\SjPhoneModel::find()->select(['id', 'title as name'])->where(['brand_id' => $parent_id])->orderBy(['sort_order' => SORT_DESC])->asArray()->all(); 
            return \yii\helpers\Json::encode(['output'=>$out, 'selected'=>empty($out) ? '' : $out[0]['id']]);
        }
    }
    return \yii\helpers\Json::encode(['output'=>'', 'selected'=>'']);
}
```

当要支持update时有点麻烦， view和controller，如下处理, 见huanping项目中的b_1_12controller.php
http://127.0.0.1/huanping/backend/web/index.php?r=b_1_12%2Fcreate

```
        <?php echo Html::hiddenInput('model_id', $model->isNewRecord ? 0 : $model->id, ['id'=>'model_id']); ?>   // 加一个id='model_id'的输入框,

        <?php echo $form->field($model, 'cat1_name')->dropDownList(B_1_1::getCat1OptionName(), ['prompt' => '选择...', 'id' => 'cat1_name']); ?>

        <?php echo $form->field($model, 'cat2_name')->label('名称')->widget(\kartik\depdrop\DepDrop::classname(), [
            'options' => ['id' => 'cat2_name', 'class' => '', 'style' => ''],
            //'data' => ['id' => $model->cat2_name], // 这个选项好象没什么用
            'pluginOptions' => [
                'depends' => ['cat1_name'],
                'placeholder' => '选择...',
                'initialize' => $model->isNewRecord ? false : true,
                'url' => Url::to(['/b_1_1/subcat']),
                'params'=>['model_id'] // 为什么要这个?  有时下拉不仅仅取决于父亲，这个可传点参数
            ],
                'pluginEvents' => [   // 见环评b_1_6/_form.php
                    //"depdrop.init"=>"function() { alert('depdrop:init');}",
                    //"depdrop.ready"=>"function() { alert('depdrop:ready');}",
                    "depdrop.change"=>"function(event, id, value, count) {
                        // alert('depdrop.change-' + id + '-' + value + '-' + count);                         
                        var cat1_name = $('#cat1_name').val();
                        var cat2_name = $('#cat2_name').val();
                        //alert('cat2_name=' + cat2_name);
                        if (cat1_name == '环保工程') {
                            $('#cat2_name_div').hide();
                            $('#cat3_name_div').show();
                        } else if (cat2_name == '其它') {
                            //$('#cat2_name_div').hide();
                            $('#cat3_name_div').show();
                        } else {
                            $('#cat2_name_div').show();
                            $('#cat3_name_div').hide();
                        }                                   
                     }",
                    //"depdrop.beforeChange"=>"function(event, id, value) { alert('depdrop:beforeChange');}",
                    //"depdrop.afterChange"=>"function(event, id, value) { alert('depdrop:afterChange' + id + value);}",
                    "depdrop.error"=>"function(event, id, value) { alert('depdrop:error');}",
                ],

        ]); ?>

Yii::error($_POST);
[
    'depdrop_parents' => [
        '辅料',
    ],
    'depdrop_params' => [
        '1',
    ],
    'depdrop_all_params' => [
        'cat1_name' => '辅料',
        'model_id' => '1',  // 这里多加了一个参数
    ],
]
    public function actionSubcat()
    {
        Yii::error($_POST);
        $out = [];
        if (isset($_POST['depdrop_all_params'])) {
            $cat1 = $_POST['depdrop_all_params']['cat1_name'];
            $model_id = $_POST['depdrop_all_params']['model_id'];

            $names = B_1_1::getCat2OptionName($cat1);
            foreach ($names as $name) {
                $out[] = ['id' => $name, 'name' => $name];
            }
            // 如果是insert
            if (empty($model_id) || empty($model = B_1_1::findOne($model_id))) {
                //return \yii\helpers\Json::encode(['output' => $out, 'selected' => empty($out) ? '' : $out[0]['id']]);
                return \yii\helpers\Json::encode(['output' => $out, 'selected' => '']);
            }
            return \yii\helpers\Json::encode(['output' => $out, 'selected' => $model->cat2_name]);
        }
        return \yii\helpers\Json::encode(['output' => '', 'selected' => '']);
    }
```

---------------下面是改进版-----------------
    // 隐藏输入框, 准备初始值

```
    <?php echo $form->field($model, 'area_parent_id')->dropDownList(AreaCode::getProvinceOption(), ['prompt' => '选择...', 'id' => 'parent_id']); ?>

    <?php echo Html::hiddenInput('selected_id', $model->isNewRecord ? '' : $model->area_id, ['id'=>'selected_id']); ?>

    <?php echo $form->field($model, 'area_id')->widget(\kartik\depdrop\DepDrop::classname(), [
        'options' => ['id' => 'area_id', 'class' => '', 'style' => ''],
        'pluginOptions' => [
            'depends' => ['parent_id'],
            'placeholder' => '选择...',
            'initialize' => $model->isNewRecord ? false : true,
            'url' => Url::to(['/area-code/subcat']),
            'params'=> ['selected_id'], // 这个组件是编辑时总是为空， 只好将它的初始值直接传过去, 
        ],
        'pluginEvents' => [
            //"depdrop.init"=>"function() { alert('depdrop:init');}",
            //"depdrop.ready"=>"function() { alert('depdrop:ready');}",
            "depdrop.change"=>"function(event, id, value, count) {
                //alert('depdrop.change-' + id + '-' + value + '-' + count);                         
                // var area_id = $('#area_id').val();
            }",
            //"depdrop.beforeChange"=>"function(event, id, value) { alert('depdrop:beforeChange');}",
            //"depdrop.afterChange"=>"function(event, id, value) { alert('depdrop:afterChange' + id + value);}",
            //"depdrop.error"=>"function(event, id, value) { alert('depdrop:error');}",
        ],

    ]); ?>


    public function actionSubcat()
    {
        Yii::error($_POST);
        $out = [];
        if (isset($_POST['depdrop_all_params'])) {
            $parent_id = $_POST['depdrop_all_params']['parent_id'];
            $selected_id = $_POST['depdrop_all_params']['selected_id']; // 取到初始值

            $out = AreaCode::find()->select(['id', 'name'])->where(['parent_id' => $parent_id])->asArray()->all();
            return \yii\helpers\Json::encode(['output' => $out, 'selected' => $selected_id]); // 在这里用上
        }

        return \yii\helpers\Json::encode(['output' => '', 'selected' => '']);
    }
```

\kartik\widgets\FileInput 
文件上传按钮, 用来替换原生的file input,它只是对native File Input的外观wrapper, 自己还要写如何处理上传文件, noam148/yii2-image-manager内部也是利用的它, 感觉它是一个半成品，仅仅是比原生的样式好一些而已?

```
<?php echo \kartik\file\FileInput::widget([
      'name' => 'attachments',
      'options' => ['multiple' => true],
      'pluginOptions' => ['previewFileType' => 'any']
]); ?>   
```
或
```
<?php echo \kartik\file\FileInput::widget([
    'name' => 'imagemanagerFiles[]',
    'id' => 'imagemanager-files',
    'options' => [
        'multiple' => true,
        'accept' => 'image/*'
    ],
    'pluginOptions' => [
        'uploadUrl' => Url::to(['/manager/upload']),
        'allowedFileExtensions' => \Yii::$app->getModule('imagemanager')->allowedFileExtensions, 
        'uploadAsync' => false,
        'showPreview' => false,
        'showRemove' => false,
        'showUpload' => false,
        'showCancel' => false,
        'browseClass' => 'btn btn-primary btn-block',
        'browseIcon' => '<i class="fa fa-upload"></i> ',
        'browseLabel' => 'Upload'
    ],
    'pluginEvents' => [
        "filebatchselected" => "function(event, files){  $('.msg-invalid-file-extension').addClass('hide'); $(this).fileinput('upload'); }",
        "filebatchuploadsuccess" => "function(event, data, previewId, index) {
            imageManagerModule.uploadSuccess(data.jqXHR.responseJSON.imagemanagerFiles);
        }",
        "fileuploaderror" => "function(event, data) { $('.msg-invalid-file-extension').removeClass('hide'); }",
    ],
]) ?>
```
// 处理动作
```
public function actionUpload() {
    // 处理多个文件
    if (isset($_FILES['imagemanagerFiles']['tmp_name'])) {
        foreach ($_FILES['imagemanagerFiles']['tmp_name'] AS $key => $sTempFile) {
            $sFileName = $_FILES['imagemanagerFiles']['name'][$key];
            $sFileExtension = pathinfo($sFileName, PATHINFO_EXTENSION);
            $iErrorCode = $_FILES['imagemanagerFiles']['error'][$key];
            if ($iErrorCode == 0) { 
                //create a file record
                $model = new ImageManager();
                $model->fileName = str_replace("_", "-", $sFileName);
                $model->fileHash = Yii::$app->getSecurity()->generateRandomString(32);
                //if file is saved add record
                if ($model->save()) {
                    $sSaveFileName = $model->id . "_" . $model->fileHash . "." . $sFileExtension;
                    //move_uploaded_file($sTempFile, $sMediaPath."/".$sFileName);
                    //save with Imagine class
                    Image::getImagine()->open($sTempFile)->save($sMediaPath . "/" . $sSaveFileName);
                }
            }
        }
    }
}
```

### kartik 挂件 
#### 开关式按钮
```
<?php echo $form->field($model, 'status')->widget(\kartik\widgets\SwitchInput::classname(), [
    'type' => \kartik\widgets\SwitchInput::CHECKBOX
]); ?>

<?php echo $form->field($model, 'status')->widget(\kartik\widgets\SwitchInput::classname(), [
    'type' => \kartik\switchinput\SwitchInput::RADIO,
    'items' => [
        [
            'label' => 'AAAA',
            'value' => 0,
        ],
        [
            'label' => 'BBBB',
            'value' => 1,
        ],
    ]
]); ?>


$ajaxUrl = Url::to(['/heipi/ajax-broker'], true);
$user_id = Yii::$app->user->id;
$js = <<<EOD
    function switchChange(value) 
    {
        var args = {
            'classname': '-common-models-Member',
            'funcname': 'ajaxSetValue',
            'params': {
                'user_id': $user_id,
                'key': 'x_param_heipi',
                'value': value
            }
        };
        $.ajax({
            url: '$ajaxUrl',
            type: 'GET',
            cache: false,
            dataType: 'json',
            data: 'args=' + encodeURIComponent(JSON.stringify(args)),
            success: function (ret) {
                if (0 === ret['code']) {
                    location.reload();
                    //$.pjax.reload('#my_pjax', {timeout: 5000});
                }
                else {
                    alert(ret['msg']);
                }
            },
            error: function (e) {
                alert('系统错误');
            }
        });

    };

EOD;

$this->registerJs($js);

// 开关式按钮click事件
    <?php
    echo SwitchInput::widget([
        'id' => 'heipi',
        'name' => 'heipi',
        'type' => SwitchInput::CHECKBOX,
        'value' => Yii::$app->user->identity->x_param_heipi,
        'pluginOptions' => [
            //'onText' => 'Yes',
            //'offText' => 'No',
            //'size' => 'mini',
            //'labelText'=>'<i class="glyphicon glyphicon-stop"></i>'
        ],
        'pluginEvents' => [
            "switchChange.bootstrapSwitch" => "function() {
                //alert('Toggle: ' + $(this).prop('checked')); 
                switchChange($(this).prop('checked'));
            }",
        ],

    ]);
    ?>

common\models\Member类中
    public static function ajaxSetValue($params)
    {
        \Yii::error($params);
        if ( empty($params['user_id']) || empty($params['key'])) {
            return Json::encode(['code' => 1, 'msg' => 'OK']);
        }

        if (null === ($model = self::findOne(['user_id' => $params['user_id']]))) {
            return Json::encode(['code' => 1, 'msg' => 'Not found']);
        }
        $model->{$params['key']} = $params['value'];
        return $model->save() ? Json::encode(['code' => 0, 'msg' => 'OK']) : Json::encode(['code' => 1, 'msg' => 'err']);
    }

```


#### spin 数据输入, 带+ - 
```
<?php echo \kartik\touchspin\TouchSpin::widget([
    'name' => 'amount',
    'options' => ['placeholder' => 'Adjust...'],
    'pluginOptions' => [
        'min' => 0,
        'max' => 100,
        'step' => 0.1,
        'decimals' => 2,
        'boostat' => 5,
        'maxboostedstep' => 10,
        'postfix' => '%',
        'verticalbuttons' => true
    ]
]); ?>
```

#### 5星投票，图标式输入
```
<?php echo $form->field($model, 'comment')->label('Rate This FAQ')->widget(\kartik\widgets\StarRating::classname(), [
    'pluginOptions' => [
        'size' => 'sm', //xl
        'stars' => 5,
        'min' => 0,
        'max' => 5,
        'step' => 0.5,
        //'showClear' => false,
        //'showCaption' => false,
        //'symbol' => html_entity_decode('&#xe005;', ENT_QUOTES, "utf-8"),
        // 'defaultCaption' => '{rating} hearts',
        'starCaptions'=>[],
        //'displayOnly' => true,
        //'disabled' => true,
        //'language' => 'zh-CN',
        'filledStar' => '<i class="glyphicon glyphicon-heart"></i>',
        'emptyStar' => '<i class="glyphicon glyphicon-heart-empty"></i>',
        'defaultCaption' => '{rating} hearts',
        'starCaptions' => new \yii\web\JsExpression("function(val){return val == 1 ? 'One heart' : val + ' hearts';}")
    ]
])?>
```

#### 输入 08:01时间点    
```
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'action_time',
                'format' => ['time', 'php:H:i'],
            ],
        ],
    ]); ?>

    public function rules()
    {
        return [
            [['action_time'], 'time', 'format' => 'php:H:i'],
        ];
    }

    <?php echo $form->field($model, 'action_time')->widget(\kartik\widgets\TimePicker::classname(), [
        'options' => ['placeholder' => '输入时间格式如09:01'],
        'pluginOptions' => [
            'minuteStep' => true,
            'showMeridian' => false,
        ]
    ]); ?>
```

#### 输入单个日期
```
<?php echo $form->field($model, 'created_at')->widget(\kartik\widgets\DatePicker::classname(), [
	'options' => ['placeholder' => 'Select date ...'],
    //'type' => \kartik\widgets\DatePicker::TYPE_INPUT,
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd',
        'autoclose' => true,
		'todayHighlight' => true
    ]
]); ?>

// 在gridview中, 当filter使用
    [
        'attribute' => 'created_at',
        'filter' => \kartik\date\DatePicker::widget([ 
            'model' => $searchModel,
            'attribute' => 'created_at',
            'options' => ['placeholder' => 'input date...'], 
            'pluginOptions' => [
                'autoclose' => true, 
                'format' => 'yyyy-mm-dd', 
                'todayHighlight' => true 
            ] 
        ]),
    ],

    //或
    [
        'attribute' => 'created_at',
        'filterType' => \kartik\grid\GridView::FILTER_DATE,
        'filterWidgetOptions' =>[
            'options' => ['placeholder' => 'input date...'], 
            'pluginOptions'=>[
                'autoclose' => true, 
                'format' => 'yyyy-mm-dd', 
                'todayHighlight' => true 
            ],
        ],
    ],
```
   
#### 显示2个输入框，分别输入起始年月日
```
<?php echo $form->field($model, 'created_at')->widget(\kartik\widgets\DatePicker::classname(), [
    'type' => \kartik\widgets\DatePicker::TYPE_RANGE,
    'attribute2' => 'updated_at',
    'options' => ['placeholder' => 'Start date'],
    'options2' => ['placeholder' => 'End date'],
    'form' => $form,
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd',
        'autoclose' => true,
        'todayHighlight' => true
    ]
]); ?>

// gridview之外，在一个组件内输入起始日期
<?php 
echo $form->field($model, 'created_at')->widget('\kartik\daterange\DateRangePicker', [
 'presetDropdown' => true, // 当它为true是, 默认日期总是为today, 感觉很不好，希望是空白, 要么关掉即presetDropdown=false, 要么另加defaultPresetValueOptions控制
 'defaultPresetValueOptions' => ['style'=>'display:none'], // 默认日期为空时隐藏today
...
]

echo \kartik\daterange\DateRangePicker::widget([
        'model' => $searchModel,
        'attribute' => 'created_at',
        'presetDropdown' => true,
 'defaultPresetValueOptions' => ['style'=>'display:none'],
        'options' => [
            'id' => 'created_at'
        ],
        'pluginOptions' => [
            'format' => 'YYYY-MM-DD',
            'separator' => ' TO ',
            'opens'=>'left',
        ] ,
        'pluginEvents' => [
            //"apply.daterangepicker" => "function() { $('.grid-view').yiiGridView('applyFilter'); }",
        ]
    ]); ?>

    // 在gridview之中， 当filter使用, columns
    [
        'attribute'=>'created_at',
        'filterType' => \kartik\grid\GridView::FILTER_DATE_RANGE,
        'filterWidgetOptions' =>([
            'presetDropdown' => TRUE,
 'defaultPresetValueOptions' => ['style'=>'display:none'],
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'YYYY-MM-DD',
                'separator' => ' TO ',
                'opens'=>'left',
            ],
        ]),
    ],

    // 在gridview之中, 这样也可以
    [
        'attribute'=>'created_at',
        'filter' => \kartik\daterange\DateRangePicker::widget([
            'model' => $searchModel,
            'attribute' => 'created_at',
            'presetDropdown' => true,
 'defaultPresetValueOptions' => ['style'=>'display:none'],
            'options' => [
                'id' => 'created_at'
            ],
            'pluginOptions' => [
                'format' => 'YYYY-MM-DD',
                'separator' => ' TO ',
                'opens'=>'left',
            ] ,
            'pluginEvents' => [
                //"apply.daterangepicker" => "function() { $('.grid-view').yiiGridView('applyFilter'); }",
            ]
        ]),
    ],

参考wxp/common/modules/outlet/FansStatController
http://127.0.0.1/wxp/backend/web/index.php?r=outlet%2Ffans-stat%2Findex&gh_id=gh_4b9887a417ef
    // 与之配套的search model
    class FansStatSearch extends FansStat
    {
        public $createTimeStart;
        public $createTimeEnd;

        public function behaviors()
        {
            return [
                [
                    'class' => \kartik\daterange\DateRangeBehavior::className(),
                    'attribute' => 'created_at',
                    'dateStartFormat' => false,
                    'dateEndFormat' => false,
                    'dateStartAttribute' => 'createTimeStart',
                    'dateEndAttribute' => 'createTimeEnd',
                ]
            ];
        }

        public function rules()
        {
            return [
                [['createTimeStart', 'createTimeEnd'], 'safe'],
            ];
        }

        public function search($params)
        {
            $query = FansStat::find();
            ...
            $query->andFilterWhere(['>=', 'DATE(created_at)', $this->createTimeStart])
                ->andFilterWhere(['<=', 'DATE(created_at)', $this->createTimeEnd]);

            return $dataProvider;
        }
    }
```


#### 时分秒输入
```
<?php echo $form->field($model, 'created_at')->widget(\kartik\widgets\TimePicker::classname(), [
    'pluginOptions' => [
        //'showSeconds' => true,
        'showMeridian' => false,
        'minuteStep' => 5,
    ]
]); ?>

<?php 
/*
年月日时分秒输入, demo地址: 
http://demos.krajee.com/widget-details/datetimepicker
http://www.malot.fr/bootstrap-datetimepicker/demo.php
*/
echo $form->field($model, 'created_at')->widget(\kartik\widgets\DateTimePicker::classname(), [
    'name' => 'datetime_10',
    'options' => ['placeholder' => 'Select operating time ...'],
    //'convertFormat' => true,
    'pluginOptions' => [
        // js参数参见 http://www.malot.fr/bootstrap-datetimepicker/
        'todayHighlight' => true,
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd hh:ii',
        'minuteStep' => 5, 
    ]
]);
?>
```

#### 加载中组件

```
<?php 
/*
旋转菊花, demo地址: 
http://demos.krajee.com/widget-details/spinner
*/
echo \kartik\widgets\Spinner::widget([
    'preset' => \kartik\widgets\Spinner::SMALL,
    'color' => '#5CB85C',
    'align' => 'left'
]);

echo '<div class="well">';
echo \kartik\widgets\Spinner::widget(['preset' => 'medium', 'align' => 'center', 'color' => 'blue']);
echo '<div class="clearfix"></div>';
echo '</div>';

echo '<button class="btn btn-primary btn-sm">';
echo \kartik\widgets\Spinner::widget(['preset' => 'tiny', 'align' => 'left', 'caption' => 'Loading &hellip;']);
echo '</button>';
?>
```

#### 文本输入框自动完成

```
/*
文本输入框自动完成, demo地址:    既可以输入串，又可以下拉选择,  autocompelete
http://demos.krajee.com/widget-details/typeahead
*/
$data = [
    'Alabama', 'Alaska', 'Arizona', 'Arkansas', 
];
 
echo $form->field($model, 'comment')->widget(\kartik\widgets\Typeahead::classname(), [
    'options' => ['placeholder' => 'Filter as you type ...'],
    'pluginOptions' => ['highlight'=>true],
    'dataset' => [
        [
            'local' => $data,
            'limit' => 10
        ]
    ]
]);

在环评中有应用 backend\views\b_3_1-new\_form.php
    <?php $data = array_keys(B_1_12::getPolluteFactorOptionName('废气', 'remove_other'));
    echo $form->field($model, 'name')->widget(Typeahead::classname(), [
        'options' => ['placeholder' => '选择或输入...'],
        'pluginOptions' => ['highlight'=>true],
        'defaultSuggestions' => $data,
        'dataset' => [
            [
                'local' => $data,
                'limit' => 100
            ]
        ]
    ]); ?>



    <?php $data = ['自产', '外购'];
        echo $form->field($model, 'from')->widget(Typeahead::classname(), [
        'options' => ['placeholder' => '选择或输入...'],
        //'disabled' => true,
//'rtl' => true,
        'pluginOptions' => ['highlight'=>true],
        'defaultSuggestions' => $data,
        'dataset' => [
            [
                'local' => $data,
                'limit' => 100
            ]
        ]
    ]); ?>



    $(document).ready(function () {
        xxx();
    });

    function xxx() {
        var cat1_name = $("#cat1_name").val();
        if (cat1_name == '《地表水环境质量标准》（GB3838-2002）') {
            $("#table_num_level").val('表1Ⅳ类');
            $("#table_num_level_div").show();
        } else {
            $("#table_num_level").val('');
            $("#table_num_level_div").hide();
        }
    }

    <?php echo $form->field($model, 'cat1_name')->widget(Typeahead::classname(), [
        'options' => ['placeholder' => '选择或输入...','id' => 'cat1_name',],
        //'disabled' => true,
        //'rtl' => true,
        'scrollable' => true,
        'pluginOptions' => ['highlight'=>true],
        'pluginEvents' => [
            "change typeahead:selected" => "function(event) { 
                //var foo = $('input.tt-input').val();
                var foo = $('#cat1_name').val(); // 选择或输入时都会触发
                xxx();
            }",
        ],
        'defaultSuggestions' => array_keys(B_1_3::getCat1OptionName()),
        'dataset' => [
            [
                'local' => array_keys(B_1_3::getCat1OptionName()),
                'limit' => 100
            ]
        ]
    ]); ?>
```


#### 左侧菜单栏
```
echo \kartik\widgets\SideNav::widget([
	'type' => \kartik\widgets\SideNav::TYPE_DEFAULT,
	'heading' => 'Options',
	'items' => [
		[
			'url' => '#',
			'label' => 'Home',
			'icon' => 'home'
		],
		[
			'label' => 'Help',
			'icon' => 'question-sign',
			'items' => [
				['label' => 'About', 'icon'=>'info-sign', 'url'=>'#'],
				['label' => 'Contact', 'icon'=>'phone', 'url'=>'#'],
			],
		],
	],
]);
```


#### tabs
```
echo \yii\bootstrap\Tabs::widget([
    'navType' => 'nav-tabs nav-justified',  //nav-justified 自动居中
    'items' => [
        [
            'label' => 'One',
            'content' => 'Anim pariatur one...',
            'active' => true
        ],
        [
            'label' => 'Two',
            'content' => 'two....',
            'headerOptions' => [],
            'options' => ['id' => 'myveryownID'],
        ],
        [
            'label' => 'Example',
            'url' => 'http://www.example.com',
        ],
        [
            'label' => 'Dropdown',
            'items' => [
                 [
                     'label' => 'DropdownA',
                     'content' => 'aaaaa',
                 ],
                 [
                     'label' => 'DropdownB',
                     'content' => 'bbbbb',
                 ],
            ],
        ],
    ],
]);

    <?= \yii\bootstrap\Nav::widget([
        'options' => [
            'class' => 'nav nav-tabs',
            'style' => 'margin-bottom: 15px'
        ],
        'items' => [
            [
                'label'   => 'CC转出',
                'url'     => ['/order/cc', 'cat' => common\models\Order::CAT_CC_OUT],
                'active' => Yii::$app->request->get('cat') == common\models\Order::CAT_CC_OUT,
            ],
            [
                'label'   => 'CC引爆',
                'url'     => ['/order/cc', 'cat' => common\models\Order::CAT_CC_EXPLOSION],
                'active' => Yii::$app->request->get('cat') == common\models\Order::CAT_CC_EXPLOSION,
            ],
        ]
    ])
    ?>
```

#### 浮动在右上角, 显示几秒的通知

// http://demos.krajee.com/widget-details/growl
// 浮动在右上角, 显示几秒的通知， 类似于flash-message, 
```
echo \kartik\growl\Growl::widget([
	'type' => \kartik\growl\Growl::TYPE_SUCCESS,
	'icon' => 'glyphicon glyphicon-ok-sign',
	'title' => 'Note',
	'showSeparator' => true,
    //'delay' => 1500,
	'body' => 'This is a successful growling alert.'
]);


// 显示message框
echo \yii\bootstrap\Alert::widget([
     'options' => [
         'class' => 'alert-info',
     ],
     'body' => 'Say hello...',
]);

// 显示几秒的flash-message框  
echo \kartik\alert\Alert::widget([
	'type' => \kartik\alert\Alert::TYPE_INFO,
    'title' => '操作成功!',
    'icon' => 'glyphicon glyphicon-ok-sign',
    'body' => '导入数据成功.',
    'showSeparator' => true,
    'delay' => 2000
]);

// bootstrap的旋转木马
echo yii\bootstrap\Carousel::widget([
  'items' => [
      // the item contains only the image
      '<img src="http://kippt.com/static/kippt.png"/>',
      // equivalent to the above
      ['content' => '<img src="http://cdn.dragonstatic.com/parking/images/sale.jpg"/>'],
      // the item contains both the image and the caption
      [
          'content' => '<img src="http://cdn.dragonstatic.com/parking/images/96040.jpg"/>',
          'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
          'options' => [],
      ],
  ]
]);
```


#### 颜色输入框
```
echo $form->field($model, 'comment')->widget(\kartik\color\ColorInput::classname(), [
    'options' => ['placeholder' => 'Select color ...'],
]);


//http://demos.krajee.com/editable
//grid带下载功能的
// 如要设了panel,那么将会使用panelTemplate生成layout,
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterSelector' => '#created_at',

        'responsive' => true,
        'resizableColumns' => true,
        'persistResize' => true,
        'resizeStorageKey' => Yii::$app->user->id . '-' . date("m"),

        //'containerOptions' => ['style'=>'overflow: auto'], // only set when $responsive = false
/*
        'beforeHeader'=>[
            [
                'columns'=>[
                    ['content'=>'Header Before 1', 'options'=>['colspan'=>4, 'class'=>'text-center warning']], 
                    ['content'=>'Header Before 2', 'options'=>['colspan'=>4, 'class'=>'text-center warning']], 
                    ['content'=>'Header Before 3', 'options'=>['colspan'=>3, 'class'=>'text-center warning']], 
                ],
                'options'=>['class'=>'skip-export'] // remove this row from export
            ]
        ],
*/
        'toolbar' =>  [
            ['content'=>
                //Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>Yii::t('kvgrid', 'Add Book'), 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['data-pjax'=>0, 'class' => 'btn btn-success', 'title'=>'创建'])
            ],
            '{export}',
            '{toggleData}'
        ],
        //'pjax' => true,
        //'bordered' => false,
        //'striped' => false,
        //'condensed' => false,
        'responsive' => true,
        //'showPageSummary' => true, //是否显示汇总栏
        //'panel' => ['type' => GridView::TYPE_PRIMARY],
        'layout' => "{toolbar}\n{summary}\n{items}\n{pager}",
        'columns' => [
           [
                'attribute' => 'amount',
                'format' => 'currency',
                'pageSummary' => true, // 是否显示
                'value'=>function ($model, $key, $index, $column) { return $model->amount / 100 ; },
           ],
           ...
```

#### editable 即点击编
// https://github.com/yii2mod/yii2-editable  这个比下面的kartik的好！


// kartik的EditableColumn的使用比较麻烦, 参考 http://webtips.krajee.com/setup-editable-column-grid-view-manipulate-records/

```
    [
        'class' => 'kartik\grid\EditableColumn',
        'attribute' => 'comment',        
        'pageSummary' => 'Page Total',
        'vAlign'=>'middle',
        'headerOptions'=>['class'=>'kv-sticky-column'],
        'contentOptions'=>['class'=>'kv-sticky-column'],
        'editableOptions'=>[
            'header'=>'Name', 
            'size'=>'md',
            //'asPopover' => false,
        ]
    ],

    // 在显示页面
    public function actionIndex()
    {
        // ...
        // 处理ajax提交的字段值
        if (Yii::$app->request->post('hasEditable')) {
            $RedpackLogId = Yii::$app->request->post('editableKey');
            $model = RedpackLog::findOne($RedpackLogId);
            $out = \yii\helpers\Json::encode(['output'=>'', 'message'=>'']);
            $posted = current($_POST['RedpackLog']);
            $post = ['RedpackLog' => $posted];
            if ($model->load($post)) {
                $model->save();
                $output = ''; // 回填到grid的值，一般为''
                if (isset($posted['amount'])) {
                    //$output = Yii::$app->formatter->asCurrency($model->amount /100);
                }                 
                $out = \yii\helpers\Json::encode(['output'=>$output, 'message'=>'']);
            }
            echo $out;
            return;
        }
    
        $searchModel = new RedpackLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
```

#### 树形管理 
// http://demos.krajee.com/tree-manager-demo/treeview
// https://github.com/kartik-v/yii2-tree-manager

```
echo \kartik\tree\TreeView::widget([
    'query' => Tree::find()->addOrderBy('root, lft'),
    'headingOptions' => ['label' => 'Categories'],
    'rootOptions' => ['label'=>'<span class="text-primary">Root</span>'],
    'fontAwesome' => true,
    'isAdmin' => true,
    'displayValue' => 1,
    'iconEditSettings'=> [
        'show' => 'list',
        'listData' => [
            'folder' => 'Folder',
            'file' => 'File',
            'mobile' => 'Phone',
            'bell' => 'Bell',
        ]
    ],
    'softDelete' => true,
    'cacheSettings' => ['enableCache' => true]
]);

配置main.php中 modules
        'treemanager' =>  [
            'class' => '\kartik\tree\Module',
            // other module settings, refer detailed documentation
        ]
```
### 模式窗口 modal form 
loveorigami/yii2-modal-ajax， 传统add按钮打开一个新页面，通过它可以打开一个modal, 在modal中展示form, 通过ajax保存form内容. 
不过这样做的好处是什么呢?  原始屏幕不动？一般保存form之后，数据都会有修改，也就是说要刷新原始屏的。

环评项目(http://127.0.0.1/huanping/backend/web/index.php?r=b_1_7)
点'编辑'这个toggleButton, 会弹出一个model, 其内容是通过url = /b_1_13/create去抓取的
view文件
```
    //use lo\widgets\modal\ModalAjax;
    echo ModalAjax::widget([
        //'id' => 'createCompany',
        'header' => '编辑',
        'toggleButton' => [
            'label' => '编辑',
            'class' => 'btn btn-primary pull-right'
        ],
        'url' => Url::to(['/b_1_13/create']), // Ajax view with form to load
        'autoClose' => true,
        'ajaxSubmit' => true, // Submit the contained form as ajax, true by default
        // ... any other yii2 bootstrap modal option you need
        'size' => Modal::SIZE_LARGE,
        'options' => [
            //'id' => 'submit_vote'.$model->id,
           //'class' => 'header-primary'
        ],
        //'footer' => 'Footer',
        'events'=>[
            ModalAjax::EVENT_MODAL_SHOW => new \yii\web\JsExpression("
                function(event, data, status, xhr, selector) {
                    //alert(111);
                }
            "),
            ModalAjax::EVENT_MODAL_SUBMIT => new \yii\web\JsExpression("
                function(event, data, status, xhr, selector) {
                    if(status == 'success'){
                        $(this).modal('toggle');
                        window.location.reload();
                    } else {
                        // alert('输入出错!');
                    }
                }
            ")
        ]
    ]);


    public function actionCreate()
    {
        $model = new B_1_13();
        if (isset($_POST['cancel'])) {
            return $this->goAnchor();
            //return $this->redirect(['/b_1_7/index', '#' => strtolower(StringHelper::basename(get_class($model)))]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (Yii::$app->request->isAjax) {
                // JSON response is expected in case of successful save
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ['success' => true];
            }

            return $this->goAnchor();
        } else {

            if (Yii::$app->request->isAjax) {
                // 准备抓取内容
                return $this->renderAjax('create', [
                    'model' => $model,
                ]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
```

modal中只有一个编辑框
```
    echo ModalAjax::widget([
        //'id' => 'createCompany',
        'header' => '编辑',
        'toggleButton' => [
            'label' => '<span class="glyphicon glyphicon-fullscreen"></span>',
            'class' => 'pull-right', //btn btn-primary
        ],
        'url' => Url::to(['/report/edit-desc', 'param' => Report::DESC_B_1_13_NEW_OLD_METHOD]), // Ajax view with form to load
        'autoClose' => true,
        'ajaxSubmit' => true, // Submit the contained form as ajax, true by default
        // ... any other yii2 bootstrap modal option you need
        'size' => Modal::SIZE_LARGE,
        'options' => [
            //'id' => 'submit_vote'.$model->id,
        ],
        //'footer' => 'Footer',
        'events' => [
            ModalAjax::EVENT_MODAL_SHOW => new \yii\web\JsExpression("
                function(event, data, status, xhr, selector) {
                    //alert(111);
                }
            "),
            ModalAjax::EVENT_MODAL_SUBMIT => new \yii\web\JsExpression("
                function(event, data, status, xhr, selector) {
                    if(status == 'success'){
                        $(this).modal('toggle');
                        window.location.reload();
                    } else {
                        // alert('输入出错!');
                    }
                }
            ")
        ]
    ]);

    public function actionEditDesc($param)
    {
        if (isset($_POST['cancel'])) {
            return $this->refresh();
        }

        $report = Util::getSessionReport();

        $dynamicModel = new DynamicModel([
            $param => Yii::$app->keyStorage->get(Report::getKeyStorageReportKey($report->id, $param)),
        ]);
        $dynamicModel->addRule([$param], 'default', ['value' => '']);

        if ($dynamicModel->load(Yii::$app->request->post()) && $dynamicModel->validate()) {
            Yii::$app->keyStorage->set(Report::getKeyStorageReportKey($report->id, $param), $dynamicModel->{$param});

            if (Yii::$app->request->isAjax) {
                // JSON response is expected in case of successful save
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ['success' => true];
            }

/*
$this->registerJs(
   '$(".flash-success").animate({opacity: 1.0}, 3000).fadeOut("slow");',
   yii\web\View::POS_READY
);
*/
            Yii::$app->session->setFlash('alert', [
                'body' => '保存成功',
                'options' => ['class' => 'alert alert-success']
            ]);
            return $this->refresh();
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('edit-desc', [
                'model' => $dynamicModel,
                'param' => $param,
            ]);
        }

        return $this->render('edit-desc', [
            'model' => $dynamicModel,
            'param' => $param,
        ]);
    }

```


### 杂项

#### 字体
https://github.com/awesome-yii/list

https://github.com/forecho/awesome-yii2


#### 解决层次问题的3种办法：
1. 解决无级分类(嵌套集合算法，就像一个大饼子内套小饼子..., 高效，用于记录比较多的场合, kartik\tree\TreeView使用了它)
https://github.com/creocoder/yii2-nested-sets

2. 解决无级分类(邻接表算法，接地气)，及层次关系 (字段除id, pid外, 还可以加一个path表示节点间的层次关系如1-3-4, select * from where path like '1-3-%' 这种左like可以很快找到子结点，而不用递归)
https://github.com/paulzi/yii2-adjacency-list      

3. 路径法 https://github.com/paulzi/yii2-materialized-path

#### 解决标签问题
https://github.com/creocoder/yii2-taggable    

解决标签问题
https://github.com/2amigos/yii2-taggable-behavior


#### 其他好用的组件
mohorev/yii2-upload-behavior    文件或图片上传，这个不错

"dmstr/yii2-adminlte-asset": "^2.3",
"kartik-v/yii2-widgets": "*",
"kartik-v/yii2-sortable-input": "^1.1",
"kartik-v/yii2-grid": "@dev",
"kartik-v/yii2-date-range": "dev-master",
"kartik-v/yii2-tree-manager": "@dev",    // 树形管理              
"2amigos/yii2-tinymce-widget" : "~1.1",
"2amigos/yii2-highcharts-widget" : "~1.0",

"2amigos/yii2-taggable-behavior": "~1.0", 
// 这个好的是有个配套的tag输入widget, 这个yii2-selectize-widget与"creocoder/yii2-taggable"搭配也可以使用
"2amigos/yii2-selectize-widget": "~1.0",

"2amigos/yii2-file-upload-widget": "~1.0" // 这个文件上传还没试过.... BlueImp File Upload wrapper, 支持多文件，有后台处理动作，但不知道怎么使用，没有sample

"noam148/yii2-image-manager" : "*",
"paulzi/yii2-adjacency-list" : "^2.0",
"paulzi/yii2-json-behavior": "^1.0",            // json字段  https://github.com/paulzi/yii2-json-behavior
"paulzi/yii2-nested-sets": "*",         // 与creocoder/yii2-nested-sets差不多  
"paulzi/yii2-sortable": "*"  //与"yii2tech/ar-position": "*"类似

"creocoder/yii2-taggable": "~2.0", 
// 这个tag本身比2amigos/yii2-taggable-behavior好一些, 可与2amigos的2amigos/yii2-selectize-widget搭配使用

"creocoder/yii2-nested-sets": "*",
"overtrue/wechat": "~3.1",
https://github.com/overtrue/easy-sms
"loveorigami/yii2-plugins-system": "^3.1"
"loveorigami/yii2-modal-ajax": "@dev"          // 以modal的形式打开一个form，环评项目(http://127.0.0.1/huanping/backend/web/index.php?r=b_1_7)


网站参数设置
"yii2mod/yii2-settings": "*"   // 
"pheme/yii2-settings": "*",      // 跟上面的类似, 类似于yii2tech/config, https://github.com/phemellc/yii2-settings    
2个都不行，还不如自己的

https://github.com/Mirocow/yii2-eav
"mirocow/yii2-eav": "*",

多语言解决方案, yeecms所采用
"omgdef/yii2-multilingual-behavior": "~2.0",
https://github.com/yeesoft/yii2-yee-eav   EAV


另外一堆
"2amigos/yii2-ckeditor-widget" : "2.0",
"2amigos/yii2-chartjs-widget" : "~2.0",
"2amigos/yii2-gallery-widget": "~1.0",
"2amigos/yii2-grid-view-library" : "*",

https://github.com/yii2tech/spreadsheet //  这个导出excel很方便!
"yii2tech/balance": "*"          //账户明细?
"yii2tech/ar-position": "*"         // 排序
"yii2tech/ar-softdelete": "*"           //软删除     paipai Tag.php中有  
```           
    public function behaviors()
    {
        return [
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::className(),
                'softDeleteAttributeValues' => [
                    'is_deleted' => true
                ],
                'replaceRegularDelete' => true // 令正常的delete()退化成软删除, 这样使用delete()是删不掉了, mutate native `delete()` method
            ],
        ];
    }
```

这个 "yii2tech/file-storage": "*"  // 这个文件系统差一点?

"yii2tech/ar-linkmany": "*"         // 简化多对多关系的处理 

这个比较简洁   https://github.com/yii2tech/ar-linkmany

"yii2tech/ar-dynattribute": "*",    // 这个好， 

比paulzi/yii2-json-behavior好(yii2 支持json数据类型后paulz的这个就无用了)

（github.com/league下面有flysystem,glide 这个2个好的php库, creocoder/yii2-flysystem是flysystem的wrapper, trntv/yii2-glide是glide的wrapp）

"creocoder/yii2-flysystem": "0.8.*" 
yii2-starter-kit/yii2-file-kit  
// 很好的组件，直接利用creocoder/yii2-flysystem这个wrapper，


https://github.com/yongtiger/yii2-bootstrap-tree 

可以显示树形数据，cc中18层关系有使用到member/tree
   ```
    echo \yongtiger\bootstraptree\widgets\BootstrapTree::widget([
        'options'=>[
            //https://github.com/jonmiles/bootstrap-treeview#options
            'data' => $items,                                   ///(needed!)
            //'data' => $aaa,                                   ///(needed!)
            'enableLinks' => true,                              ///(optional)
            'showTags' => true,                                 ///(optional)
            'levels' => 18,                                      ///(optional)
            //'selectedBackColor' => '#cccccc',
            //'selectedBackColor' => '#ffffff',
            'selectedBackColor' => '#ffff00',
            //'multiSelect' => true,  ///(optional, but when `selectParents` is true, you must also set this to true!)
        ],
        'htmlOptions' => [                                      ///(optional)
            'id' => 'treeview-tabs',
        ],
        'events'=>[	                                            ///(optional)
            //https://github.com/jonmiles/bootstrap-treeview#events
            'onNodeSelected' => 'function(event, data) {
                // alert(data.text);
            }'
        ],

        ///(needed for using jonmiles bootstrap-treeview 2.0.0, must specify it as `<a href="{href}">{text}</a>`)
        'textTemplate' => '<a href="{href}">{text}</a>',

        ///(optional) Note: when it is true, you must also set `multiSelect` of the treeview widget options to true!
        //'selectParents' => true,
    ]);
```

trntv/yii2-glide  // 图片云处理

"wbraganca/yii2-dynamicform": "*"  //多行输入，动态+, 有点意思
"wbraganca/yii2-fancytree-widget": "*"   //树形选择器?


"dektrium/yii2-user"    // https://github.com/dektrium/yii2-user      

// 前台用户注册，login, ... 后台管理 composer require dektrium/yii2-user  
用得不怎么自由，比较束缚人!

"yiisoft/yii2-queue": "~2.0"  // 官方队列

https://github.com/rmrevin/yii2-fontawesome   // 有了它, 使用icon很方便, 显示图标
\rmrevin\yii\fontawesome\FontAwesome::icon('angle-double-right')
\yii\bootstrap\Html::icon('star')

#### 2个灯箱组件
https://github.com/newerton/yii2-fancybox
   ```
    <?php
    echo newerton\fancybox\FancyBox::widget([
        'target' => 'a[rel=fancybox]',
        'helpers' => true,
        'mouse' => true,
        'config' => [
            'maxWidth' => '90%',
            'maxHeight' => '90%',
            'playSpeed' => 7000,
            'padding' => 0,
            'fitToView' => false,
            'width' => '70%',
            'height' => '70%',
            'autoSize' => false,
            'closeClick' => false,
            'openEffect' => 'elastic',
            'closeEffect' => 'elastic',
            'prevEffect' => 'elastic',
            'nextEffect' => 'elastic',
            'closeBtn' => false,
            'openOpacity' => true,
            'helpers' => [
                'title' => ['type' => 'float'],
                'buttons' => [],
                'thumbs' => ['width' => 68, 'height' => 50],
                'overlay' => [
                    'css' => [
                        'background' => 'rgba(0, 0, 0, 0.8)'
                    ]
                ]
            ],
        ]
    ]);

    echo Html::a(Html::img('@web/images/32.jpg', ['width' => '100']), '@web/images/32.jpg', ['style' => 'margin-right:10px;', 'rel' => 'fancybox']);
    echo Html::a(Html::img('@web/images/34.jpg', ['width' => '100']), '@web/images/34.jpg', ['rel' => 'fancybox']);
    ?>
```

下面这个也不错
    https://github.com/2amigos/yii2-gallery-widget
```
    <?php $items = [
        [
            'url' => '@web/images/32.jpg', // 大图
            'src' => '@web/images/32.jpg', // 小图
            'options' => array('title' => '这是大图'),
            'imageOptions' => ['width' => '100'],
        ],
        [
            'url' => '@web/images/34.jpg',
            'src' => '@web/images/34.jpg',
            'imageOptions' => ['width' => '100'],
        ],
    ];?>
    <?= dosamigos\gallery\Gallery::widget(['items' => $items, ]);?>
```


#### 社交
http://www.humhub.org



以下没什么用
"yiier/yii2-aliyun-oss": "*"  
"jamband/yii2-schemadump": "*"   // 将db生成migration

------ToggleColumn ------
不好的地方是toggle时没有confirm
            gridview文件

```
            [
                'class' => '\pheme\grid\ToggleColumn',
                'attribute' => 'status',
                'action' => 'toggle-status',
                'onText' => '执行冻结',
                'offText' => '执行解冻',
                'displayValueText' => true,
                'onValueText' => '已冻结',
                'offValueText' => '已正常',
                'iconOn' => 'stop',
                'iconOff' => 'stop'
                // Uncomment if  you don't want AJAX
                //'enableAjax' => false,
            ],

controller.php
use pheme\grid\actions\ToggleAction;
    public function actions()
    {
        return [
            'toggle-status' => [
                'class' => ToggleAction::className(),
                'modelClass' => 'common\models\Member',
                'attribute' => 'status',
                // Uncomment to enable flash messages
                'setFlash' => true,
            ]
        ];
    }
```