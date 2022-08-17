<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2021
 * @package yii2-widgets
 * @subpackage yii2-widget-alert
 * @version 1.1.5
 */

namespace kartik\alert;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\web\View;

/**
 * Alert methods trait for [[AlertBs4]] and [[AlertBs3]] widgets
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
trait AlertMethodsTrait
{
    use AlertTrait;

    /**
     * @inheritdoc
     */
    public function run()
    {
        echo $this->getTitle();
        parent::run();
    }

    /**
     * Gets the title section
     *
     * @return string
     */
    protected function getTitle()
    {
        $icon = '';
        $title = '';
        $separator = '';
        if (!empty($this->icon) && $this->iconType == 'image') {
            $icon = Html::img($this->icon, $this->iconOptions);
        } elseif (!empty($this->icon)) {
            $this->iconOptions['class'] = $this->icon . ' ' . (empty($this->iconOptions['class']) ? 'kv-alert-title' :
                    $this->iconOptions['class']);
            $icon = Html::tag('span', '', $this->iconOptions) . ' ';
        }
        if (!empty($this->title)) {
            if (empty($this->titleOptions['class'])) {
                $this->titleOptions['class'] = 'kv-alert-title';
            }
            $tag = ArrayHelper::remove($this->titleOptions, 'tag', 'span');
            $title = Html::tag($tag, $this->title, $this->titleOptions);
            if ($this->showSeparator) {
                $separator = '<hr class="kv-alert-separator">' . "\n";
            }
        }
        return $icon . $title . $separator;
    }

    /**
     * @inheritdoc
     */
    protected function initOptions()
    {
        parent::initOptions();
        if (empty($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        $this->registerAssets();
        Html::addCssClass($this->options, 'kv-alert ' . $this->type);
    }

    /**
     * Register the client assets for the [[Alert]] widget.
     */
    protected function registerAssets()
    {
        /**
         * @var View $view
         */
        $view = $this->getView();
        AlertAsset::register($view);

        if (!empty($this->delay) && $this->delay > 0) {
            $js = 'jQuery("#' . $this->options['id'] . '").fadeTo(' . $this->delay . ', 0.00, function() {
				$(this).slideUp("slow", function() {
					$(this).remove();
				});
			});';
            $view->registerJs($js);
        }
    }
}
