<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2021
 * @package yii2-widgets
 * @subpackage yii2-widget-alert
 * @version 1.1.5
 */

namespace kartik\alert;

/**
 * Interface used in [[Alert]], [[AlertBs4]] and [[AlertBs3]] widgets.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
interface AlertInterface
{
    /**
     * information alert
     */
    const TYPE_INFO = 'alert-info';
    /**
     * danger/error alert
     */
    const TYPE_DANGER = 'alert-danger';
    /**
     * success alert
     */
    const TYPE_SUCCESS = 'alert-success';
    /**
     * warning alert
     */
    const TYPE_WARNING = 'alert-warning';
    /**
     * primary alert
     */
    const TYPE_PRIMARY = 'bg-primary';
    /**
     * default alert
     */
    const TYPE_DEFAULT = 'well';
    /**
     * custom alert
     */
    const TYPE_CUSTOM = 'alert-custom';
}
