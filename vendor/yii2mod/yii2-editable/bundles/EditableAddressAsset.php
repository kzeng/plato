<?php

namespace yii2mod\editable\bundles;

use yii\web\AssetBundle;

/**
 * Class EditableAddressAsset
 *
 * @package yii2mod\editable\bundles
 */
class EditableAddressAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@vendor/yii2mod/yii2-editable/assets/address';

    /**
     * @var array
     */
    public $css = [
        'bootstrap-editable-address.css',
    ];

    /**
     * @var array
     */
    public $js = [
        'bootstrap-editable-address.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        'yii2mod\editable\bundles\EditableBootstrapAsset',
    ];
}
