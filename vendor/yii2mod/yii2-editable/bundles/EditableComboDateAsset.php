<?php

namespace yii2mod\editable\bundles;

use yii\web\AssetBundle;

/**
 * Class EditableComboDateAsset
 *
 * @package yii2mod\editable\bundles
 */
class EditableComboDateAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@vendor/yii2mod/yii2-editable/assets/combodate';

    /**
     * @var array
     */
    public $js = [
        'vendor/moment-with-langs.min.js',
        'vendor/combodate.js',
        'bootstrap-editable-combodate.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        'yii2mod\editable\bundles\EditableBootstrapAsset',
    ];
}
