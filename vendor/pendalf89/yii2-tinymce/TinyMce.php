<?php
namespace pendalf89\tinymce;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

/**
 * TinyMCE renders a tinyMCE js plugin for WYSIWYG editing.
 */
class TinyMce extends InputWidget
{
    /**
     * @var array the options for the TinyMCE JS plugin.
     * Please refer to the TinyMCE JS plugin Web page for possible options.
     * @see http://www.tinymce.com/wiki.php/Configuration
     */
    public $clientOptions = [];

    /** 
     * @var bool whether to set the on change event for the editor. This is required to be able to validate data.
     */
    public $triggerSaveOnBeforeValidateForm = true;

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->hasModel()) {
            $output = Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            $output = Html::textarea($this->name, $this->value, $this->options);
        }

        $this->registerClientScript();
        return $output;
    }

    /**
     * Registers Twitter TypeAhead Bootstrap plugin and the related events
     */
    protected function registerClientScript()
    {
        $js = [];
        $id = $this->options['id'];
        TinyMceAsset::register($this->view);
        $this->clientOptions['selector'] = "#{$id}";

        if (!empty($this->clientOptions['language'])) {
            $language_url = LanguageAsset::register($this->view)->baseUrl . "/{$this->clientOptions['language']}.js";
            $this->clientOptions['language_url'] = $language_url;
        }

        $options = Json::encode($this->clientOptions);
        $js[] = "tinymce.init($options);";
        
        if ($this->triggerSaveOnBeforeValidateForm) {
            $js[] = "$('#{$id}').parents('form').on('beforeValidate', function() { tinymce.triggerSave(); });";
        }
        $this->view->registerJs(implode("\n", $js));
    }
}
