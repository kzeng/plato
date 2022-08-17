yii2-tinymce
============

Renders a TinyMCE WYSIWYG text editor plugin widget. Inspired by [2amigos/yii2-tinymce-widget](https://github.com/2amigos/yii2-tinymce-widget) extension

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist pendalf89/yii2-tinymce "*"
```

or add

```
"pendalf89/yii2-tinymce": "*"
```

to the require section of your `composer.json` file.

Usage
------------
In view files:

```php
use pendalf89\tinymce\TinyMce;

<?= $form->field($model, 'text')->widget(TinyMce::className(), [
    'clientOptions' => [
        'language' => 'ru',
        'plugins' => [
            "advlist autolink lists link charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
    ],
    'triggerSaveOnBeforeValidateForm' => true, // Переключатель необходимости сохранения окна редактирования в поле textarea перед валидацией формы
]); ?>
```

