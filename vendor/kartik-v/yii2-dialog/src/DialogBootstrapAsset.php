<?php

/**
 * @package   yii2-dialog
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2021
 * @version   1.0.6
 */

namespace kartik\dialog;
use kartik\base\PluginAssetBundle;

/**
 * Asset bundle for Bootstrap 3 Dialog
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class DialogBootstrapAsset extends PluginAssetBundle
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->depends = array_merge(['kartik\dialog\DialogAsset'], $this->depends);
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('js', ['js/bootstrap-dialog']);
        $this->setupAssets('css', ['css/bootstrap-dialog-bs' . (!$this->isBs(3) ? '4' : '3')]);
        parent::init();
    }
}
