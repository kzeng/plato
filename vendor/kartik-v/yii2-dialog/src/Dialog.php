<?php

/**
 * @package   yii2-dialog
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2021
 * @version   1.0.6
 */

namespace kartik\dialog;

use Exception;
use ReflectionException;
use Yii;
use kartik\base\Widget;
use yii\base\InvalidConfigException;
use yii\helpers\Json;
use yii\web\View;

/**
 * Dialog widget allows an easy configuration to control javascript dialogs and also generate rich styled bootstrap
 * modal dialogs using [bootstrap3-dialog](https://github.com/nakupanda/bootstrap3-dialog) plugin. The widget provides
 * its own advanced javascript library `KrajeeDialog` that acts a polyfill for the native javascript alert, confirm, and
 * prompt dialog boxes.
 *
 * **Example 1: ** Usage for a default dialog.
 *
 * ```php
 * echo Dialog::widget([
 *    'libName' => 'krajeeDialog',
 *    'options => [], // default options
 * ]);
 *```
 *
 * **Example 2: ** Usage for a customized dialog.
 *
 * ```php
 * echo Dialog::widget([
 *    'libName' => 'krajeeDialogCust',
 *    'options => ['draggable' => true, 'closable' => true], // custom options
 * ]);
 * ```
 *
 * Then you can use your own javascript as shown below to render your alert, confirm, and prompt boxes:
 *
 * ```js
 * // use krajeeDialog object instance
 * $('#btn-1').on('click', function() {
 *     krajeeDialog.alert('An alert');
 *     // or show a confirm
 *     krajeeDialog.confirm('Are you sure', function(out){
 *         if(out) {
 *             alert('Yes'); // or do something on confirmation
 *         }
 *     });
 *
 * });
 *
 * // use krajeeDialogCust object instance
 * $('#btn-2').on('click', function() {
 *     krajeeDialogCust.alert('An alert');
 *     // or show a prompt
 *     krajeeDialogCust.prompt({label:'Provide reason', placeholder:'Upto 30 characters...'}, function(out){
 *         if (out) {
 *             alert('Yes'); // or do something based on the value of out
 *         }
 *     });
 *
 * });
 * ```
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class Dialog extends Widget
{
    /**
     * Krajee JS dialog library class name.
     */
    const LIBRARY = 'krajeeDialog';
    /**
     * Alert method name in the KrajeeDialog JS class.
     */
    const DIALOG_ALERT = 'alert';
    /**
     * Confirm method name in the KrajeeDialog JS class.
     */
    const DIALOG_CONFIRM = 'confirm';
    /**
     * Prompt method name in the KrajeeDialog JS class.
     */
    const DIALOG_PROMPT = 'prompt';
    /**
     * Other dialog method name in the KrajeeDialog JS class.
     */
    const DIALOG_OTHER = 'dialog';
    /**
     * The **default** bootstrap contextual color type.
     */
    const TYPE_DEFAULT = 'type-default';
    /**
     * The **primary** bootstrap contextual color type.
     */
    const TYPE_PRIMARY = 'type-primary';
    /**
     * The **information** bootstrap contextual color type.
     */
    const TYPE_INFO = 'type-info';
    /**
     * The **danger** bootstrap contextual color type.
     */
    const TYPE_DANGER = 'type-danger';
    /**
     * The **warning** bootstrap contextual color type.
     */
    const TYPE_WARNING = 'type-warning';
    /**
     * The **success** bootstrap contextual color type.
     */
    const TYPE_SUCCESS = 'type-success';
    /**
     * Bootstrap **normal** modal dialog size.
     */
    const SIZE_NORMAL = 'size-normal';
    /**
     * Bootstrap **small** modal dialog size.
     */
    const SIZE_SMALL = 'size-small';
    /**
     * Bootstrap **large** modal dialog size.
     */
    const SIZE_LARGE = 'size-large';
    /**
     * Bootstrap **wide** modal dialog size. The `size-wide` is equal to bootstrap `modal-lg` size.
     */
    const SIZE_WIDE = 'size-wide';

    /**
     * @var string icon CSS suffix to be added for the OK button in the dialog.
     */
    public $iconOk;

    /**
     * @var string icon CSS suffix to be added for the CANCEL button in the dialog.
     */
    public $iconCancel;

    /**
     * @var string icon CSS suffix to be added for the SPINNER button in the dialog.
     */
    public $iconSpinner;

    /**
     * @var boolean whether to use the native javascript dialog for rendering the popup prompts. If set to `false`, the
     * bootstrap3-dialog library will be used for rendering the prompts as a modal dialog.
     */
    public $useNative = false;

    /**
     * @var boolean whether to override the yii javascript confirmation dialog (set via `data-confirm`)
     * with KrajeeDialog confirmation dialog.
     */
    public $overrideYiiConfirm = true;

    /**
     * @var string the identifying name of the public javascript id that will hold the settings for KrajeeDialog
     * javascript object instance. Defaults to `krajeeDialog`.
     */
    public $libName = self::LIBRARY;

    /**
     * @var boolean (DEPRECATED) applicable only for versions v1.0.3 and below, where if set to `true` 
     * will enable a draggable cursor for draggable dialog boxes when dragging.
     *
     * for v1.0.6 and above the cursor will always be displayed irrespective of this setting 
     * (which can be controlled via CSS).
     */
    public $showDraggable = true;

    /**
     * @var array the configuration options for the bootstrap dialog (applicable when [[useNative]] is `false`). You can
     * set the configuration settings as key value pairs that can be recognized by the BootstrapDialog plugin.
     */
    public $options = [];

    /**
     * @var array the default dialog settings for alert, confirm, and prompt.
     */
    public $dialogDefaults = [];

    /**
     * @var integer the registration position for the Krajee dialog JS client code.
     */
    public $jsPosition = View::POS_HEAD;

    /**
     * @inheritdoc
     */
    protected $_msgCat = 'kvdialog';

    /**
     * @inheritdoc
     * @throws ReflectionException
     * @throws InvalidConfigException
     */
    public function run()
    {
        $this->initI18N();
        $this->initOptions();
        $this->registerAssets();
    }

    /**
     * Initialize the dialog buttons.
     * @throws InvalidConfigException|Exception
     */
    public function initOptions()
    {
        $notBs3 = !$this->isBs(3);
        $defaultBtnCss = $notBs3 ? 'btn-outline-secondary' : 'btn-default';
        $this->iconOk = $notBs3 ? 'fas fa-check' : 'glyphicon glyphicon-ok';
        $this->iconCancel = $notBs3 ? 'fas fa-ban' : 'glyphicon glyphicon-ban-circle';
        $this->iconSpinner = $notBs3 ? 'fas fa-asterisk' : 'glyphicon glyphicon-asterisk';
        $ok = Yii::t('kvdialog', 'Ok');
        $cancel = Yii::t('kvdialog', 'Cancel');
        $info = Yii::t('kvdialog', 'Information');
        $okLabel = '<span class="' . $this->iconOk . '"></span> ' . $ok;
        $cancelLabel = '<span class="' . $this->iconCancel . '"></span> ' . ' ' . $cancel;
        $promptDialog = $otherDialog = [
            'draggable' => false,
            'title' => $info,
            'buttons' => [
                ['label' => $cancel, 'icon' => $this->iconCancel, 'cssClass' => $defaultBtnCss],
                ['label' => $ok, 'icon' => $this->iconOk, 'cssClass' => 'btn-primary'],
            ],
        ];
        $otherDialog['draggable'] = true;
        $promptDialog['closable'] = false;
        $this->dialogDefaults = array_replace_recursive([
            self::DIALOG_ALERT => [
                'type' => self::TYPE_INFO,
                'title' => $info,
                'buttonLabel' => $okLabel,
            ],
            self::DIALOG_CONFIRM => [
                'type' => self::TYPE_WARNING,
                'title' => Yii::t('kvdialog', 'Confirmation'),
                'btnOKClass' => 'btn-warning',
                'btnOKLabel' => $okLabel,
                'btnCancelLabel' => $cancelLabel
            ],
            self::DIALOG_PROMPT => $promptDialog,
            self::DIALOG_OTHER => $otherDialog,
        ], $this->dialogDefaults);
    }

    /**
     * Registers the client assets for [[Dialog]] widget.
     */
    public function registerAssets()
    {
        $view = $this->getView();
        if (!$this->useNative) {
            DialogBootstrapAsset::registerBundle($view, $this->bsVersion);
        }
        DialogAsset::register($view);
        $flag = $this->useNative ? 'false' : 'true';
        $opts = Json::encode($this->options);
        $optsVar = self::LIBRARY . '_' . hash('crc32', $opts);
        $defaults = Json::encode($this->dialogDefaults);
        $defaultsVar = self::LIBRARY . 'Defaults_' . hash('crc32', $defaults);
        $pos = $this->jsPosition;
        $view->registerJs("var {$defaultsVar} = {$defaults};", $pos);
        $view->registerJs("var {$optsVar} = {$opts};", $pos);
        $view->registerJs("var {$this->libName}=new KrajeeDialog({$flag},{$optsVar},{$defaultsVar});", $pos);
        if ($this->overrideYiiConfirm) {
            DialogYiiAsset::register($view);
            $view->registerJs("krajeeYiiConfirm('{$this->libName}');");
        }
    }
}
