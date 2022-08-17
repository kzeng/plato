<?php

namespace yii2mod\editable\bundles;

use yii\web\AssetBundle;

/**
 * Class EditableDateTimePickerAsset
 *
 * @package yii2mod\editable\bundles
 */
class EditableDateTimePickerAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@vendor/yii2mod/yii2-editable/assets/datetimepicker';

    /**
     * @var array
     */
    public $depends = [
        'yii2mod\editable\bundles\EditableBootstrapAsset',
    ];

    /**
     * Init object
     */
    public function init()
    {
        $this->css[] = 'vendor/css/bootstrap-datetimepicker.min.css';
        $this->js[] = 'vendor/js/bootstrap-datetimepicker.min.js';
        $this->js[] = 'bootstrap-editable-datetimepicker.js';
        parent::init();
    }
}
