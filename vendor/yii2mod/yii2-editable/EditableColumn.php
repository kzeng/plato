<?php

namespace yii2mod\editable;

use yii\base\InvalidConfigException;
use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii2mod\editable\bundles\EditableAddressAsset;
use yii2mod\editable\bundles\EditableBootstrapAsset;
use yii2mod\editable\bundles\EditableComboDateAsset;
use yii2mod\editable\bundles\EditableDatePickerAsset;
use yii2mod\editable\bundles\EditableDateTimePickerAsset;

/**
 * Class EditableColumn
 *
 * @package yii2mod\editable
 */
class EditableColumn extends DataColumn
{
    /**
     * Editable options
     */
    public $editableOptions = [];

    /**
     * @var string suffix substituted to a name class of the tag <a>
     */
    public $classSuffix;

    /**
     * @var string the url to post
     */
    public $url;

    /**
     * @var string the type of editor
     */
    public $type = 'text';

    /**
     * @var string
     */
    public $format = 'raw';

    /**
     * @var array
     */
    public $clientOptions = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->url === null) {
            throw new InvalidConfigException('The "url" property must be set.');
        }

        $rel = $this->attribute . '_editable' . $this->classSuffix;
        $this->options['pjax'] = '0';
        $this->options['rel'] = $rel;

        $this->registerClientScript();
    }

    /**
     * Renders the data cell content.
     *
     * @param mixed $model the data model
     * @param mixed $key the key associated with the data model
     * @param int $index the zero-based index of the data model among the models array returned by [[GridView::dataProvider]]
     *
     * @return string the rendering result
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        $value = parent::renderDataCellContent($model, $key, $index);
        $url = (array) $this->url;
        $this->options['data-url'] = Url::to($url);
        $this->options['data-pk'] = base64_encode(serialize($key));
        $this->options['data-name'] = $this->attribute;
        $this->options['data-type'] = $this->type;

        if (is_callable($this->editableOptions)) {
            $opts = call_user_func($this->editableOptions, $model, $key, $index);
            foreach ($opts as $prop => $v) {
                $this->options['data-' . $prop] = $v;
            }
        } elseif (is_array($this->editableOptions)) {
            foreach ($this->editableOptions as $prop => $v) {
                $this->options['data-' . $prop] = $v;
            }
        }

        return Html::a($value, null, $this->options);
    }

    /**
     * Registers required script to the columns work
     */
    protected function registerClientScript()
    {
        $view = $this->grid->getView();
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

        $rel = $this->options['rel'];
        $selector = "a[rel=\"$rel\"]";
        $js[] = ";jQuery('$selector').editable({$this->getClientOptions()});";
        $view->registerJs(implode("\n", $js));
    }

    /**
     * Return client options in json format
     *
     * @return string
     */
    public function getClientOptions()
    {
        return Json::encode($this->clientOptions);
    }
}
