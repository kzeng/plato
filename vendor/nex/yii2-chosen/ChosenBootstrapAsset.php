<?php
/**
 * @copyright Copyright (c) 2016 Oleg Balykin
 * @link https://github.com/ezoterik
 * @version 1.0.0
 */
namespace nex\chosen;

use yii\web\AssetBundle;

/**
 * ChosenBootstrapAsset
 *
 * @author Oleg Balykin <ezoterik@gmail.com>
 * @link https://github.com/RomeroMsk/yii2-chosen
 * @see http://harvesthq.github.io/chosen
 */
class ChosenBootstrapAsset extends AssetBundle
{
    public $sourcePath = '@bower/chosen-bootstrap';

    public $css = [
        'chosen.bootstrap.css',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
        'nex\chosen\ChosenAsset',
    ];
}
