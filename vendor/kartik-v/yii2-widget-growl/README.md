<h1 align="center">
    <a href="http://demos.krajee.com" title="Krajee Demos" target="_blank">
        <img src="http://kartik-v.github.io/bootstrap-fileinput-samples/samples/krajee-logo-b.png" alt="Krajee Logo"/>
    </a>
    <br>
    yii2-widget-growl
    <hr>
    <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DTP3NZQ6G2AYU"
       title="Donate via Paypal" target="_blank"><img height="60" src="https://kartik-v.github.io/bootstrap-fileinput-samples/samples/donate.png" alt="Donate"/></a>
    &nbsp; &nbsp; &nbsp;
    <a href="https://www.buymeacoffee.com/kartikv" title="Buy me a coffee" ><img src="https://cdn.buymeacoffee.com/buttons/v2/default-yellow.png" height="60" alt="kartikv" /></a>
</h1>

<div align="center">

[![Stable Version](https://poser.pugx.org/kartik-v/yii2-widget-growl/v/stable)](https://packagist.org/packages/kartik-v/yii2-widget-growl)
[![Unstable Version](https://poser.pugx.org/kartik-v/yii2-widget-growl/v/unstable)](https://packagist.org/packages/kartik-v/yii2-widget-growl)
[![License](https://poser.pugx.org/kartik-v/yii2-widget-growl/license)](https://packagist.org/packages/kartik-v/yii2-widget-growl)
[![Total Downloads](https://poser.pugx.org/kartik-v/yii2-widget-growl/downloads)](https://packagist.org/packages/kartik-v/yii2-widget-growl)
[![Monthly Downloads](https://poser.pugx.org/kartik-v/yii2-widget-growl/d/monthly)](https://packagist.org/packages/kartik-v/yii2-widget-growl)
[![Daily Downloads](https://poser.pugx.org/kartik-v/yii2-widget-growl/d/daily)](https://packagist.org/packages/kartik-v/yii2-widget-growl)

</div>

A widget that turns standard Bootstrap alerts into "Growl-like" notifications. This widget is a wrapper for the Bootstrap Growl [plugin by remabledesigns](http://bootstrap-growl.remabledesigns.com).
 
> NOTE: This extension is a sub repo split of [yii2-widgets](https://github.com/kartik-v/yii2-widgets). The split has been done since 08-Nov-2014 to allow developers to install this specific widget in isolation if needed. One can also use the extension the previous way with the whole suite of [yii2-widgets](http://demos.krajee.com/widgets).

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/). Check the [composer.json](https://github.com/kartik-v/yii2-widget-growl/blob/master/composer.json) for this extension's requirements and dependencies. Read this [web tip /wiki](http://webtips.krajee.com/setting-composer-minimum-stability-application/) on setting the `minimum-stability` settings for your application's composer.json.

To install, either run

```
$ php composer.phar require kartik-v/yii2-widget-growl "*"
```

or add

```
"kartik-v/yii2-widget-growl": "*"
```

to the ```require``` section of your `composer.json` file.

## Latest Release

> Refer the [CHANGE LOG](https://github.com/kartik-v/yii2-widget-alert/blob/master/CHANGE.md) for details on changes to various releases.

## Demo

You can refer detailed [documentation and demos](http://demos.krajee.com/widget-details/growl) on usage of the extension.

## Usage

```php
use kartik\growl\Growl;

echo Growl::widget([
	'type' => Growl::TYPE_SUCCESS,
	'icon' => 'glyphicon glyphicon-ok-sign',
	'title' => 'Note',
	'showSeparator' => true,
	'body' => 'This is a successful growling alert.'
]);
```

## License

**yii2-widget-growl** is released under the BSD-3-Clause License. See the bundled `LICENSE.md` for details.