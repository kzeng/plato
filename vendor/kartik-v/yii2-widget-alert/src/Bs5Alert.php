<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2021
 * @package yii2-widgets
 * @subpackage yii2-widget-alert
 * @version 1.1.5
 */

namespace kartik\alert;

use yii\bootstrap5\Alert;

/**
 * Alert widget extends the [[Alert]] widget with an easier configuration and additional styling options including
 * auto fade out.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class Bs5Alert extends Alert implements AlertInterface
{
    use AlertMethodsTrait;
}
