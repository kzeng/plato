<h1 align="center">
    <a href="http://demos.krajee.com" title="Krajee Demos" target="_blank">
        <img src="http://kartik-v.github.io/bootstrap-fileinput-samples/samples/krajee-logo-b.png" alt="Krajee Logo"/>
    </a>
    <br>
    yii2-widget-typeahead
    <hr>
    <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DTP3NZQ6G2AYU"
       title="Donate via Paypal" target="_blank"><img height="60" src="https://kartik-v.github.io/bootstrap-fileinput-samples/samples/donate.png" alt="Donate"/></a>
    &nbsp; &nbsp; &nbsp;
    <a href="https://www.buymeacoffee.com/kartikv" title="Buy me a coffee" ><img src="https://cdn.buymeacoffee.com/buttons/v2/default-yellow.png" height="60" alt="kartikv" /></a>
</h1>

<div align="center">

[![Stable Version](https://poser.pugx.org/kartik-v/yii2-widget-typeahead/v/stable)](https://packagist.org/packages/kartik-v/yii2-widget-typeahead)
[![Unstable Version](https://poser.pugx.org/kartik-v/yii2-widget-typeahead/v/unstable)](https://packagist.org/packages/kartik-v/yii2-widget-typeahead)
[![License](https://poser.pugx.org/kartik-v/yii2-widget-typeahead/license)](https://packagist.org/packages/kartik-v/yii2-widget-typeahead)
[![Total Downloads](https://poser.pugx.org/kartik-v/yii2-widget-typeahead/downloads)](https://packagist.org/packages/kartik-v/yii2-widget-typeahead)
[![Monthly Downloads](https://poser.pugx.org/kartik-v/yii2-widget-typeahead/d/monthly)](https://packagist.org/packages/kartik-v/yii2-widget-typeahead)
[![Daily Downloads](https://poser.pugx.org/kartik-v/yii2-widget-typeahead/d/daily)](https://packagist.org/packages/kartik-v/yii2-widget-typeahead)

</div>

The Typeahead extension is a Yii 2 wrapper widget for for the [Twitter Typeahead.js plugin](http://twitter.github.com/typeahead.js/examples) with certain custom enhancements. The latest release uses the [typeahead.js fork from corejavascript](https://github.com/corejavascript/typeahead.js). The `yii2-widget-typeahead` extension is a jQuery based replacement for text inputs providing search and typeahead functionality. It is inspired by twitter.com's autocomplete search functionality and based on Twitter's typeahead.js, which is described as a fast and fully-featured autocomplete library. The widget is specially styled for Bootstrap 3.x, 4.x, or 5.x. The widget allows graceful degradation to a normal HTML text input, if the browser does not support JQuery. You can also setup model validation rules for the widget like any other field. The extension offers two variations of the widget implementation: 

- `TypeaheadBasic`: This widget is a basic implementation of the *typeahead.js* plugin without any suggestion engine. 
  It uses a javascript substring matcher and Regular Expression matching to query and display suggestions. 
  [```VIEW DEMO```](http://demos.krajee.com/widget-details/typeahead-basic)
  
- `Typeahead`: This widget is an advanced implementation of the *typeahead.js* plugin with the *BloodHound* suggestion
   engine and the *Handlebars* template compiler.
  [```VIEW DEMO```](http://demos.krajee.com/widget-details/typeahead)

> NOTE: This extension is a sub repo split of [yii2-widgets](https://github.com/kartik-v/yii2-widgets). The split has been done since 08-Nov-2014 to allow developers to install this specific widget in isolation if needed. One can also use the extension the previous way with the whole suite of [yii2-widgets](http://demos.krajee.com/widgets).

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/). Check the [composer.json](https://github.com/kartik-v/yii2-widget-typeahead/blob/master/composer.json) for this extension's requirements and dependencies. Read this [web tip /wiki](http://webtips.krajee.com/setting-composer-minimum-stability-application/) on setting the `minimum-stability` settings for your application's composer.json.

To install, either run

```
$ php composer.phar require kartik-v/yii2-widget-typeahead "*"
```

or add

```
"kartik-v/yii2-widget-typeahead": "*"
```

to the ```require``` section of your `composer.json` file.

## Latest Release

> Refer the [CHANGE LOG](https://github.com/kartik-v/yii2-widget-typeahead/blob/master/CHANGE.md) for details on changes to various releases.

## Demo

You can refer detailed documentation and demos for [TypeaheadBasic](http://demos.krajee.com/widget-details/typeahead-basic) or [Typeahead](http://demos.krajee.com/widget-details/typeahead) for understanding the usage of the extension.

## Usage

```php
use kartik\typeahead\TypeaheadBasic;
use kartik\typeahead\Typeahead;

// TypeaheadBasic usage with ActiveForm and model
echo $form->field($model, 'state_3')->widget(TypeaheadBasic::classname(), [
    'data' => $data,
    'pluginOptions' => ['highlight' => true],
    'options' => ['placeholder' => 'Filter as you type ...'],
]);

// Typeahead usage with ActiveForm and model
echo $form->field($model, 'state_4')->widget(Typeahead::classname(), [
    'dataset' => [
        [
            'local' => $data,
            'limit' => 10
        ]
    ],
    'pluginOptions' => ['highlight' => true],
    'options' => ['placeholder' => 'Filter as you type ...'],
]);
```

## License

**yii2-widget-typeahead** is released under the BSD-3-Clause License. See the bundled `LICENSE.md` for details.