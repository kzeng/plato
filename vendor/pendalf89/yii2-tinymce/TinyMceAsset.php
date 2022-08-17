<?php
namespace pendalf89\tinymce;

use yii\web\AssetBundle;

class TinyMceAsset extends AssetBundle
{
    public $sourcePath = '@vendor/tinymce/tinymce';
    public $js = ['tinymce.min.js'];
    public $depends = ['yii\web\JqueryAsset'];
} 
