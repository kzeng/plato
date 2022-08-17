<?php

namespace yii2mod\editable\bundles;

use yii\web\AssetBundle;

/**
 * Class EditableDatePickerAsset
 *
 * @package yii2mod\editable\bundles
 */
class EditableDatePickerAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@vendor/yii2mod/yii2-editable/assets/datepicker';

    /**
     * @var array
     */
    public $css = [
        'vendor/css/datepicker3.css',
    ];

    /**
     * @var array
     */
    public $js = [
        'vendor/js/bootstrap-datepicker.js',
        'bootstrap-editable-datepicker.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        'yii2mod\editable\bundles\EditableBootstrapAsset',
    ];
}
