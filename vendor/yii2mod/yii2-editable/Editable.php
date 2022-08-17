<?php

namespace yii2mod\editable;

use yii\base\InvalidConfigException;
use yii\db\ActiveRecordInterface;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\InputWidget;
use yii2mod\editable\bundles\EditableAddressAsset;
use yii2mod\editable\bundles\EditableBootstrapAsset;
use yii2mod\editable\bundles\EditableComboDateAsset;
use yii2mod\editable\bundles\EditableDatePickerAsset;
use yii2mod\editable\bundles\EditableDateTimePickerAsset;

/**
 * Class Editable
 *
 * @package yii2mod\editable
 */
class Editable extends InputWidget
{
    /**
     * @var string the type of input. Type of input
     */
    public $type = 'text';

    /**
     * @var string the Mode of editable, can be popup or inline
     */
    public $mode = 'inline';

    /**
     * @var string placement of bootstrap popover
     */
    public $placement = 'top';

    /**
     * @var string|array Url for submit, e.g. '/post'
     */
    public $url;

    /**
     * @var array the options for the X-editable.js plugin
     */
    public $pluginOptions = [];

    /**
     * @var array the event handlers for the X-editable.js plugin
     */
    public $clientEvents = [];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();

        if ($this->url === null) {
            throw new InvalidConfigException("You must setup the 'Url' property.");
        }

        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->hasModel() ? Html::getInputId($this->model, $this->attribute) : $this->getId();
        }
    }

    /**
     * Executes the widget.
     */
    public function run()
    {
        $this->registerClientScript();

        return Html::a($this->getLinkText(), null, $this->options);
    }

    /**
     * Register client script
     */
    protected function registerClientScript()
    {
        $view = $this->getView();
        switch ($this->type) {
            case 'address':
                EditableAddressAsset::register($view);
                break;
            case 'combodate':
                EditableComboDateAsset::register($view);
                break;
            case 'date':
                EditableDatePickerAsset::register($view);
                break;
            case 'datetime':
                EditableDateTimePickerAsset::register($view);
                break;
            default:
                EditableBootstrapAsset::register($view);
        }
        $id = ArrayHelper::remove($this->pluginOptions, 'selector', '#' . $this->options['id']);
        $id = preg_replace('/([.])/', '\\\\\\\$1', $id);

        $pluginOptions = $this->getPluginOptions();
        $js = "jQuery('$id').editable($pluginOptions);";
        $view->registerJs($js);
        if (!empty($this->clientEvents)) {
            $this->registerClientEvents($id);
        }
    }

    /**
     * Return plugin options in json format
     *
     * @return string
     */
    public function getPluginOptions()
    {
        $pk = ArrayHelper::getValue(
            $this->pluginOptions,
            'pk',
            $this->hasActiveRecord() ? $this->model->getPrimaryKey() : null
        );
        $this->pluginOptions['pk'] = base64_encode(serialize($pk));
        $this->pluginOptions['url'] = $this->url instanceof JsExpression ? $this->url : Url::toRoute($this->url);
        $this->pluginOptions['type'] = $this->type;
        $this->pluginOptions['mode'] = $this->mode;
        $this->pluginOptions['name'] = $this->attribute ?: $this->name;
        $this->pluginOptions['placement'] = $this->placement;

        if ($this->hasActiveRecord() && $this->model->isNewRecord) {
            $this->pluginOptions['send'] = 'always';
        }

        return Json::encode($this->pluginOptions);
    }

    /**
     * Register client events
     *
     * @param $id
     */
    public function registerClientEvents($id)
    {
        $view = $this->getView();
        $js = [];
        foreach ($this->clientEvents as $event => $handler) {
            $js[] = "jQuery('$id').on('$event', $handler);";
        }
        $view->registerJs(implode("\n", $js));
    }

    /**
     * Return link text
     *
     * @return mixed|string
     */
    protected function getLinkText()
    {
        $value = $this->value;
        if ($this->hasModel()) {
            $model = $this->model;
            if ($value !== null) {
                if (is_string($value)) {
                    $linkText = ArrayHelper::getValue($model, $value);
                } else {
                    $linkText = call_user_func($value, $model);
                }
            } else {
                $linkText = ArrayHelper::getValue($model, $this->attribute);
            }
        } else {
            $linkText = $value;
        }

        return $linkText;
    }

    /**
     * To ensure that `getPrimaryKey()` and `getIsNewRecord()` methods are implemented in model.
     *
     * @return bool
     */
    protected function hasActiveRecord()
    {
        return $this->hasModel() && $this->model instanceof ActiveRecordInterface;
    }
}
