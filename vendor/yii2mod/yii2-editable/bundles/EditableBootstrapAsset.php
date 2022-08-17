<?php

namespace yii2mod\editable\bundles;

use yii\web\AssetBundle;

/**
 * Class EditableBootstrapAsset
 *
 * @package yii2mod\editable\bundles
 */
class EditableBootstrapAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@bower/x-editable/dist/bootstrap-editable';

    /**
     * @var array
     */
    public $css = [
        'css/bootstrap-editable.css',
    ];

    /**
     * @var array
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
    ];

    /**
     * Init object
     */
    public function init()
    {
        $this->js[] = '/js/main/editable.min.js';
    }
}
