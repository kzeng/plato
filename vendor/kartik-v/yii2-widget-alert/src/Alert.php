<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2021
 * @package yii2-widgets
 * @subpackage yii2-widget-alert
 * @version 1.1.5
 */

namespace kartik\alert;

use kartik\base\Widget;
use yii\base\InvalidConfigException;

/**
 * Alert widget extends the yii2 bootstrap Alert widget with an easier configuration and additional
 * styling options including auto fade out.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class Alert extends Widget implements AlertInterface
{
    use AlertTrait;

    /**
     * @var string the body content in the alert component. Note that anything between the [[begin()]] and [[end()]]
     * calls of the Alert widget will also be treated as the body content, and will be rendered before this.
     */
    public $body;

    /**
     * @var array|false the options for rendering the close button tag. The close button is displayed in the header of
     * the modal window. Clicking on the button will hide the modal window. If this is false, no close button will be
     * rendered.
     *
     * The following special options are supported:
     *
     * - tag: string, the tag name of the button. Defaults to 'button'.
     * - label: string, the label of the button. Defaults to '&times;'.
     *
     * The rest of the options will be rendered as the HTML attributes of the button tag. Please refer to the
     * [Alert documentation](http://getbootstrap.com/components/#alerts) for the supported HTML attributes.
     */
    public $closeButton = [];

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function run()
    {
        $opts = [
            'type' => $this->type,
            'body' => $this->body,
            'closeButton' => $this->closeButton,
            'iconType' => $this->iconType,
            'icon' => $this->icon,
            'iconOptions' => $this->iconOptions,
            'title' => $this->title,
            'titleOptions' => $this->titleOptions,
            'showSeparator' => $this->showSeparator,
            'clientOptions' => $this->pluginOptions,
            'clientEvents' => $this->pluginEvents,
            'options' => $this->options,
        ];
        if (isset($this->delay)) {
            $opts['delay'] = $this->delay;
        }
        /**
         * @var Widget $class
         */
        $class = '\\kartik\\alert\\Bs' . $this->getBsVer() . 'Alert';
        return $class::widget($opts);
    }
}
