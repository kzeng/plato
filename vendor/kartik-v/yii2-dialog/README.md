<h1 align="center">
    <a href="http://demos.krajee.com" title="Krajee Demos" target="_blank">
        <img src="http://kartik-v.github.io/bootstrap-fileinput-samples/samples/krajee-logo-b.png" alt="Krajee Logo"/>
    </a>
    <br>
    yii2-dialog
    <hr>
    <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DTP3NZQ6G2AYU"
       title="Donate via Paypal" target="_blank">
        <img src="http://kartik-v.github.io/bootstrap-fileinput-samples/samples/donate.png" alt="Donate"/>
    </a>
</h1>

[![Stable Version](https://poser.pugx.org/kartik-v/yii2-dialog/v/stable)](https://packagist.org/packages/kartik-v/yii2-dialog)
[![Unstable Version](https://poser.pugx.org/kartik-v/yii2-dialog/v/unstable)](https://packagist.org/packages/kartik-v/yii2-dialog)
[![License](https://poser.pugx.org/kartik-v/yii2-dialog/license)](https://packagist.org/packages/kartik-v/yii2-dialog)
[![Total Downloads](https://poser.pugx.org/kartik-v/yii2-dialog/downloads)](https://packagist.org/packages/kartik-v/yii2-dialog)
[![Monthly Downloads](https://poser.pugx.org/kartik-v/yii2-dialog/d/monthly)](https://packagist.org/packages/kartik-v/yii2-dialog)
[![Daily Downloads](https://poser.pugx.org/kartik-v/yii2-dialog/d/daily)](https://packagist.org/packages/kartik-v/yii2-dialog)

A widget component for Yii Framework 2.0 to easily configure and initialize popup notification dialog boxes. It provides a polyfill for 
the native javascript alert, confirm, and prompt dialog boxes. It includes inbuilt support for rendering rich dialog boxes via a customized 
plugin by Krajee based on and enhanced from [bootstrap3-dialog](http://nakupanda.github.io/bootstrap3-dialog/). This plugin makes using Bootstrap's 
modal more monkey-friendly. The Krajee enhancements also includes enhanced support for Bootstrap 5.x, 4.x and 3.x. The key features provided by 
the library are:

- Control how you want to render JAVASCRIPT dialogs. Inbuilt quick support for following dialog types:
    - ALERT dialog
    - CONFIRM dialog
    - PROMPT dialog
    - CUSTOM dialog
- Includes a jQuery plugin `krajeeDialog` (created by Krajee), that allows one to configure the bootstrap3-dialog library easily, or use the native JS alerting component, OR also configure any third party JS Notification Library to be used.
- Ability to render pretty dialogs by overriding and enhancing confirmation dialog for links that use yii's `data-confirm` methods.
- Advanced configuration via `kartik\dialog\Dialog` widget. This widget allows one to globally setup the native JS alert OR bootstrap3-dialog settings.

How to contribute via a pull request?
-------------------------------------
Refer this [git workflow for contributors](.github/GIT-WORKFLOW.md).

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

### Pre-requisites
> Note: Check the [composer.json](https://github.com/kartik-v/yii2-dialog/blob/master/composer.json) for this extension's requirements and dependencies. 
You must set the `minimum-stability` to `dev` in the **composer.json** file in your application root folder before installation of this extension OR
if your `minimum-stability` is set to any other value other than `dev`, then set the following in the require section of your composer.json file

```
kartik-v/yii2-dialog: "@dev"
```

Read this [web tip /wiki](http://webtips.krajee.com/setting-composer-minimum-stability-application/) on setting the `minimum-stability` settings for your application's composer.json.

### Release Changes
Refer the [CHANGE LOG](https://github.com/kartik-v/yii2-dialog/blob/master/CHANGE.md) for details of various releases.

### Install

Either run

```
$ php composer.phar require kartik-v/yii2-dialog "@dev"
```

or add

```
"kartik-v/yii2-dialog": "@dev"
```

to the ```require``` section of your `composer.json` file.

## Documentation and Demo

View the [documentation and demos](http://demos.krajee.com/dialog) at Krajee Yii 2 Demos for details on using the extension.

## Usage

### Basic Usage 

In your view you can load the asset bundle and render the javascript to load the bootstrap 3 modal dialog.

```php
// view.php
use kartik\dialog\DialogAsset;
DialogAsset::register($this);
$this->registerJs("\$('#your-btn-id').on('click', function(){BootstrapDialog.alert('I want banana!');});");
```

### Advanced Usage (Widget)

In your view OR view layout file, you can render the widget like this. This will not display any content directly - but will render all the javascript and css needed for initializing the BootstrapDialog as per your customized settings.

```php
use kartik\dialog\Dialog;

// Example 1
echo Dialog::widget([
   'libName' => 'krajeeDialog',
   'options' => [], // default options
]);

// Example 2
echo Dialog::widget([
   'libName' => 'krajeeDialogCust',
   'options' => ['draggable' => true, 'closable' => true], // custom options
]);
```

Then in your view, you can write your own javascript to render your alert, confirm, and prompt boxes (or a custom dialog box). For example on click of HTML buttons `btn-1` and `btn-2`, the dialogs can be popped up as shown below:

```js
// NOTE: This is a javascript code and must be run in Yii via 'registerJs' 
//       or via a JS File in an AssetBundle

// use krajeeDialog object instance initialized by the widget
$('#btn-1').on('click', function() {
    krajeeDialog.alert('An alert');
    // or show a confirm
    krajeeDialog.confirm('Are you sure', function(out){
        if(out) {
            alert('Yes'); // or do something on confirmation
        }
    });
});

// use krajeeDialogCust object instance
$('#btn-2').on('click', function() {
    krajeeDialogCust.alert('An alert');
    // or show a prompt
    krajeeDialogCust.prompt({label:'Provide reason', placeholder:'Upto 30 characters...'}, function(out){
        if (out) {
            alert('Yes'); // or do something based on the value of out
        }
    });
});
```

### Overriding Yii's Confirmation Dialog

Yii renders the native confirmation dialog on links that are rendered by setting `data-confirm` property on links. This widget
enhances and beautifies the native confirmation dialog using Krajee Dialog. This behavior can be controlled via the `overrideYiiConfirm` 
property which defaults to `true`. This can be useful in rendering links and action buttons like the GridView ActionColumn
delete button.

```php
// the rendered link will automatically show a Krajee Dialog Confirmation dialog
use kartik\dialog\Dialog;
echo Dialog::widget(['overrideYiiConfirm' => true]);
echo Html::a(
    'Delete', 
    ['/item/delete', 'id' => $model->id], 
    [
        'data-confirm' => 'Are you sure to delete this item?'
        'data-method' => 'post'
    ]
);
```

## License

**yii2-dialog** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.