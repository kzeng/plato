<?php
/**
 * @link https://github.com/2amigos/yii2-gallery-widget
 * @copyright Copyright (c) 2013-2016 2amigOS! Consulting Group LLC
 * @license http://opensource.org/licenses/BSD-3-Clause
 */

namespace dosamigos\gallery;

use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;

/**
 * Gallery renders a BlueImp Gallery items
 *
 * @author Alexander Kochetov <creocoder@gmail.com>
 */
class Gallery extends Widget
{
    /**
     * @var array the HTML attributes for the links container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];
    /**
     * @var array the HTML attributes for the lightbox container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $templateOptions = [];
    /**
     * @var array the options for the BlueImp Gallery plugin.
     * Please refer to the BlueImp Gallery plugin Web page for possible options.
     * @see https://github.com/blueimp/Gallery/blob/master/README.md#setup
     */
    public $clientOptions = [];
    /**
     * @var array the event handlers for the underlying Bootstrap Switch 3 input JS plugin.
     * Please refer to the [BlueImp Gallery plugin](https://github.com/blueimp/Gallery/blob/master/README.md#event-callbacks)
     * for information about their callbacks.
     */
    public $clientEvents = [];
    /**
     * @var array The array of items that compound the gallery. The syntax is as follows:
     *
     * - src: string, the image to display
     * - url: string, the image to display on the lightbox. If none found, will display `src`
     * - options: HTML attributes of the link
     * - imageOptions: HTML attributes of the image to be displayed
     */
    public $items = array();
    /**
     * @var bool whether to display the controls on initialization
     */
    public $showControls = true;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        $this->templateOptions['id'] = ArrayHelper::getValue($this->templateOptions, 'id', 'blueimp-gallery');
        Html::addCssClass($this->templateOptions, 'blueimp-gallery');
        if ($this->showControls) {
            Html::addCssClass($this->templateOptions, 'blueimp-gallery-controls');
        }

        foreach($this->clientEvents as $key => $event) {
            if(!($event instanceof JsExpression)) {
                $this->clientOptions[$key] = new JsExpression($event);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if (empty($this->items)) {
            return null;
        }
        echo $this->renderItems();
        echo $this->renderTemplate();
        $this->registerClientScript();
    }

    /**
     * @return string the items that are need to be rendered.
     */
    public function renderItems()
    {
        $items = [];
        foreach ($this->items as $item) {
            $items[] = $this->renderItem($item);
        }
        return Html::tag('div', implode("\n", array_filter($items)), $this->options);
    }

    /**
     * @param mixed $item
     * @return null|string the item to render
     */
    public function renderItem($item)
    {
        if (is_string($item)) {
            return Html::a(Html::img($item), $item, ['class' => 'gallery-item']);
        }
        $src = ArrayHelper::getValue($item, 'src');
        if ($src === null) {
            return null;
        }
        $url = ArrayHelper::getValue($item, 'url', $src);
        $options = ArrayHelper::getValue($item, 'options', []);
        $imageOptions = ArrayHelper::getValue($item, 'imageOptions', []);
        Html::addCssClass($options, 'gallery-item');

        return Html::a(Html::img($src, $imageOptions), $url, $options);
    }

    /**
     * Renders the template to display the images on a lightbox
     * @return string the template
     */
    public function renderTemplate()
    {
        $template[] = '<div class="slides"></div>';
        $template[] = '<h3 class="title"></h3>';
        $template[] = '<a class="prev">‹</a>';
        $template[] = '<a class="next">›</a>';
        $template[] = '<a class="close">×</a>';
        $template[] = '<a class="play-pause"></a>';
        $template[] = '<ol class="indicator"></ol>';

        return Html::tag('div', implode("\n", $template), $this->templateOptions);
    }

    /**
     * Registers the client script required for the plugin
     */
    public function registerClientScript()
    {
        $view = $this->getView();
        GalleryAsset::register($view);
        DosamigosAsset::register($view);

        $id = $this->options['id'];
        $options = Json::encode($this->clientOptions);
        $js = "dosamigos.gallery.registerLightBoxHandlers('#$id a', $options);";
        $view->registerJs($js);

        if (!empty($this->clientEvents)) {
            $js = [];
            foreach ($this->clientEvents as $event => $handler) {
                $js[] = "jQuery('$id').on('$event', $handler);";
            }
            $view->registerJs(implode("\n", $js));
        }
    }
}
