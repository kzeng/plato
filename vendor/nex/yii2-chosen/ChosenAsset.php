<?php
/**
 * @copyright Copyright (c) 2014 Roman Ovchinnikov
 * @link https://github.com/RomeroMsk
 * @version 1.0.1
 */
namespace nex\chosen;

use yii\web\AssetBundle;

/**
 * ChosenAsset
 *
 * @author Roman Ovchinnikov <nex.software@gmail.com>
 * @link https://github.com/RomeroMsk/yii2-chosen
 * @see http://harvesthq.github.io/chosen
 */
class ChosenAsset extends AssetBundle
{
    public $sourcePath = '@bower/chosen';

    public $js = [
        'chosen.jquery.min.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
