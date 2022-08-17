<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2021
 * @package yii2-widgets
 * @subpackage yii2-widget-alert
 * @version 1.1.5
 */

namespace kartik\alert;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\base\Widget;
use kartik\base\Config;
use kartik\growl\Growl;

/**
 * AlertBlock widget groups multiple [[Alert]] or [[Growl]] widgets as one single block. You can choose to
 * automatically read and display session flash messages (which is the default setting) or setup your own block of
 * custom alerts.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class AlertBlock extends Widget
{
    /**
     * Default bootstrap alert style 
     */
    const TYPE_ALERT = 'alert';
    /**
     * Bootstrap growl plugin alert style
     */
    const TYPE_GROWL = 'growl';

    /**
     * @var string the type of alert to use. Can be one of [[TYPE_ALERT]] or [[TYPE_GROWL]]. Defaults to [[TYPE_ALERT]].
     */
    public $type = self::TYPE_ALERT;

    /**
     * @var integer time in milliseconds to delay the fade out of each alert. If set to `0` or `false`, alerts
     * will never fade out and will be always displayed. This defaults to `2000` ms for [[TYPE_ALERT]] and
     * `1000` ms for [[TYPE_GROWL]].
     */
    public $delay;

    /**
     * @var boolean whether to automatically use messages set via `Yii::$app->session->setFlash()`. Defaults to `true`.
     * If set to `false`, you would need to pass the `body` setting within [[alertSetting]] array.
     */
    public $useSessionFlash = true;

    /**
     * @var array the alert types configuration for the alert messages. This array is setup as `$alert => $settings`,
     * where:
     *
     * - `$alert`: _string_, is the name of the session flash variable (e.g. `error`, `success`, `info`, `warning`).
     * - `$settings`: _array_, the [[Alert]] or [[Growl]] widget settings depending on the [[type]] set.
     */
    public $alertSettings = [];

    /**
     * @var array the options for rendering the close button tag. This will be overridden by the `closeButton` setting
     * within the [[alertSettings]] configuration.
     */
    public $closeButton = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->initOptions();
        echo Html::beginTag('div', $this->options) . "\n";
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        parent::run();
        if ($this->useSessionFlash) {
            $this->renderFlashAlerts();
        } else {
            $this->renderAlerts();
        }
        echo "\n" . Html::endTag('div');
    }

    /**
     * Initializes widget options and settings.
     *
     * @throws InvalidConfigException
     */
    protected function initOptions()
    {
        if ($this->type == self::TYPE_GROWL) {
            Config::checkDependency('growl\Growl', 'yii2-widget-growl', 'for rendering Growl notifications in the alert block');
        }
        if (empty($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        if (!isset($this->delay)) {
            $this->delay = ($this->type == self::TYPE_ALERT) ? 2000 : 1200;
        }
        if (empty($this->alertSettings) && $this->type == self::TYPE_GROWL) {
            $this->alertSettings = [
                'error' => ['type' => Growl::TYPE_DANGER],
                'success' => ['type' => Growl::TYPE_SUCCESS],
                'info' => ['type' => Growl::TYPE_INFO],
                'warning' => ['type' => Growl::TYPE_WARNING],
                'growl' => ['type' => Growl::TYPE_GROWL]
            ];
        } elseif (empty($this->alertSettings)) {
            $this->alertSettings = [
                'error' => ['type' => Alert::TYPE_DANGER],
                'success' => ['type' => Alert::TYPE_SUCCESS],
                'info' => ['type' => Alert::TYPE_INFO],
                'warning' => ['type' => Alert::TYPE_WARNING],
                'primary' => ['type' => Alert::TYPE_PRIMARY],
                'default' => ['type' => Alert::TYPE_DEFAULT]
            ];
        }
    }

    /**
     * Renders alerts from session flash settings.
     * @see [[\yii\web\Session::getAllFlashes()]]
     */
    public function renderFlashAlerts()
    {
        $type = ($this->type == self::TYPE_GROWL) ? self::TYPE_GROWL : self::TYPE_ALERT;
        $session = Yii::$app->getSession();
        $flashes = $session->getAllFlashes();
        $delay = $this->delay;
        foreach ($flashes as $alert => $config) {
            if (!empty($this->alertSettings[$alert])) {
                $messages = is_array($config) ? $config : [$config];
                foreach($messages as $message) {
                    $settings = $this->alertSettings[$alert];
                    $settings['body'] = $message;
                    if (empty($settings['closeButton'])) {
                        $settings['closeButton'] = $this->closeButton;
                    }
                    $settings['delay'] = $delay;
                    $delay += $this->delay;
                    echo ($type == self::TYPE_GROWL) ? Growl::widget($settings) : Alert::widget($settings);
                }
                $session->removeFlash($alert);
            }
        }
    }

    /**
     * Renders manually set alerts
     */
    public function renderAlerts()
    {
        $type = ($this->type == self::TYPE_GROWL) ? self::TYPE_GROWL : self::TYPE_ALERT;
        foreach ($this->alertSettings as $alert => $settings) {
            if (!empty($settings['body'])) {
                echo ($type == self::TYPE_GROWL) ? Growl::widget($settings) : Alert::widget($settings);
            }
        }
    }

    /**
     * Renders the close button.
     *
     * @return string the rendering result
     */
    protected function renderCloseButton()
    {
        if ($this->closeButton !== null) {
            $tag = ArrayHelper::remove($this->closeButton, 'tag', 'button');
            $label = ArrayHelper::remove($this->closeButton, 'label', '&times;');
            if ($tag === 'button' && !isset($this->closeButton['type'])) {
                $this->closeButton['type'] = 'button';
            }

            return Html::tag($tag, $label, $this->closeButton);
        } else {
            return null;
        }
    }
}
