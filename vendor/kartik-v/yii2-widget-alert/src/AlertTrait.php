<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2021
 * @package yii2-widgets
 * @subpackage yii2-widget-alert
 * @version 1.1.5
 */

namespace kartik\alert;

/**
 * Alert properties trait for [[Alert]], [[AlertBs4]] and [[AlertBs3]] widgets
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
trait AlertTrait
{
    /**
     * @var string the type of the alert to be displayed. One of the `TYPE_` constants.
     */
    public $type;

    /**
     * @var string the icon type. Can be either 'class' or 'image'. Defaults to 'class'.
     */
    public $iconType;

    /**
     * @var string the class name for the icon to be displayed. If set to empty or null, will not be displayed.
     */
    public $icon;

    /**
     * @var array the HTML attributes for the icon.
     */
    public $iconOptions;

    /**
     * @var string the title for the alert. If set to empty or null, will not be displayed.
     */
    public $title;

    /**
     * @var array the HTML attributes for the title. The following options are additionally recognized:
     *
     * - `tag`: _string_, the HTML tag to render the title. Defaults to `span`.
     */
    public $titleOptions;

    /**
     * @var boolean show the title separator. Only applicable if [[title]] is set.
     */
    public $showSeparator;

    /**
     * @var integer the delay in microseconds after which the alert will be displayed. Will be useful when multiple
     * alerts are to be shown.
     */
    public $delay;
}
