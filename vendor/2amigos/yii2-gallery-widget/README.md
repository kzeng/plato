# Gallery Widget for Yii2

[![Latest Version](https://img.shields.io/github/tag/2amigos/yii2-gallery-widget.svg?style=flat-square&label=release)](https://github.com/2amigos/yii2-gallery-widget/tags)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/2amigos/yii2-gallery-widget/master.svg?style=flat-square)](https://travis-ci.org/2amigos/yii2-gallery-widget)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/2amigos/yii2-gallery-widget.svg?style=flat-square)](https://scrutinizer-ci.com/g/2amigos/yii2-gallery-widget/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/2amigos/yii2-gallery-widget.svg?style=flat-square)](https://scrutinizer-ci.com/g/2amigos/yii2-gallery-widget)
[![Total Downloads](https://img.shields.io/packagist/dt/2amigos/yii2-gallery-widget.svg?style=flat-square)](https://packagist.org/packages/2amigos/yii2-gallery-widget)

Renders a BlueImp Gallery and/or Carousel. BlueImp Gallery is a touch-enabled, responsive and customizable image & video
gallery, carousel and lightbox, optimized for both mobile and desktop web browsers. It features swipe, mouse and keyboard
navigation, transition effects, slideshow functionality, fullscreen support and on-demand content loading and can be
extended to display additional.

For more information, please visit [http://blueimp.github.io/Gallery/](http://blueimp.github.io/Gallery/)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
$ composer require 2amigos/yii2-gallery-widget:~1.0
```

or add

```
"2amigos/yii2-gallery-widget": "~1.0"
```

to the `require` section of your `composer.json` file.

## Usage

### Using Gallery With LightBox

```
// on your view
<?php $items = [
    [
        'url' => 'http://farm8.static.flickr.com/7429/9478294690_51ae7eb6c9_b.jpg',
        'src' => 'http://farm8.static.flickr.com/7429/9478294690_51ae7eb6c9_s.jpg',
        'options' => array('title' => 'Camposanto monumentale (inside)')
    ],
    [
        'url' => 'http://farm3.static.flickr.com/2863/9479121747_0b37c63fe7_b.jpg',
        'src' => 'http://farm3.static.flickr.com/2863/9479121747_0b37c63fe7_s.jpg',
        'options' => array('title' => 'Hafsten - Sunset')
    ],
    [
        'url' => 'http://farm4.static.flickr.com/3712/9478186779_81c2e5f7ef_b.jpg',
        'src' => 'http://farm4.static.flickr.com/3712/9478186779_81c2e5f7ef_s.jpg',
        'options' => array('title' => 'Sail us to the Moon')
    ],
    [
        'url' => 'http://farm4.static.flickr.com/3789/9476654149_b4545d2f25_b.jpg',
        'src' => 'http://farm4.static.flickr.com/3789/9476654149_b4545d2f25_s.jpg',
        'options' => array('title' => 'Sail us to the Moon')
    ],
    [
        'url' => 'http://farm8.static.flickr.com/7429/9478868728_e9109aff37_b.jpg',
        'src' => 'http://farm8.static.flickr.com/7429/9478868728_e9109aff37_s.jpg',
        'options' => array('title' => 'Sail us to the Moon')
    ],
    [
        'url' => 'http://farm4.static.flickr.com/3825/9476606873_42ed88704d_b.jpg',
        'src' => 'http://farm4.static.flickr.com/3825/9476606873_42ed88704d_s.jpg',
        'options' => array('title' => 'Sail us to the Moon')
    ],
    [
        'url' => 'http://farm4.static.flickr.com/3749/9480072539_e3a1d70d39_b.jpg',
        'src' => 'http://farm4.static.flickr.com/3749/9480072539_e3a1d70d39_s.jpg',
        'options' => array('title' => 'Sail us to the Moon')
    ],
    [
        'url' => 'http://farm8.static.flickr.com/7352/9477439317_901d75114a_b.jpg',
        'src' => 'http://farm8.static.flickr.com/7352/9477439317_901d75114a_s.jpg',
        'options' => array('title' => 'Sail us to the Moon')
    ],
    [
        'url' => 'http://farm4.static.flickr.com/3802/9478895708_ccb710cfd1_b.jpg',
        'src' => 'http://farm4.static.flickr.com/3802/9478895708_ccb710cfd1_s.jpg',
        'options' => array('title' => 'Sail us to the Moon')
    ],
];?>
<?= dosamigos\gallery\Gallery::widget(['items' => $items]);?>
// ...
```

### Using Carousel With Json Encoded Items

```
// on your view
<?php $items = [
    [
        'title' => 'Sintel',
        'href' => 'http://media.w3.org/2010/05/sintel/trailer.mp4',
        'type' => 'video/mp4',
        'poster' => 'http://media.w3.org/2010/05/sintel/poster.png'
    ],
    [
        'title' => 'Big Buck Bunny',
        'href' => 'http://upload.wikimedia.org/wikipedia/commons/7/75/Big_Buck_Bunny_Trailer_400p.ogg',
        'type' => 'video/ogg',
        'poster' => 'http://upload.wikimedia.org/wikipedia/commons/thumb/7/70/Big.Buck.Bunny.-.Opening.Screen.png/' .
            '800px-Big.Buck.Bunny.-.Opening.Screen.png'
    ],
    [
        'title' => 'Elephants Dream',
        'href' => 'http://upload.wikimedia.org/wikipedia/commons/transcoded/8/83/Elephants_Dream_%28high_quality%29.ogv/' .
            'Elephants_Dream_%28high_quality%29.ogv.360p.webm',
        'type' => 'video/webm',
        'poster' => 'http://upload.wikimedia.org/wikipedia/commons/thumb/9/90/Elephants_Dream_s1_proog.jpg/' .
            '800px-Elephants_Dream_s1_proog.jpg'
    ],
    [
        'title' => 'LES TWINS - An Industry Ahead',
        'href' => 'http://www.youtube.com/watch?v=zi4CIXpx7Bg',
        'type' => 'text/html',
        'youtube' => 'zi4CIXpx7Bg',
        'poster' => 'http://img.youtube.com/vi/zi4CIXpx7Bg/0.jpg'
    ],
    [
        'title' => 'KN1GHT - Last Moon',
        'href' => 'http://vimeo.com/73686146',
        'type' => 'text/html',
        'vimeo' => '73686146',
        'poster' => 'http://b.vimeocdn.com/ts/448/835/448835699_960.jpg'
    ]
];?>
<?= dosamigos\gallery\Carousel::widget([
    'items' => $items, 'json' => true,
    'clientEvents' => [
        'onslide' => 'function(index, slide) {
            console.log(slide);
        }'
]]);
// ...
```


## Multiple Carousel instances on one page
```
// on your view
<?php $items = [
    [
        'title' => 'Sintel',
        'href' => 'http://media.w3.org/2010/05/sintel/trailer.mp4',
        'type' => 'video/mp4',
        'poster' => 'http://media.w3.org/2010/05/sintel/poster.png'
    ],
    [
        'title' => 'Big Buck Bunny',
        'href' => 'http://upload.wikimedia.org/wikipedia/commons/7/75/Big_Buck_Bunny_Trailer_400p.ogg',
        'type' => 'video/ogg',
        'poster' => 'http://upload.wikimedia.org/wikipedia/commons/thumb/7/70/Big.Buck.Bunny.-.Opening.Screen.png/' .
            '800px-Big.Buck.Bunny.-.Opening.Screen.png'
    ],
    [
        'title' => 'Elephants Dream',
        'href' => 'http://upload.wikimedia.org/wikipedia/commons/transcoded/8/83/Elephants_Dream_%28high_quality%29.ogv/' .
            'Elephants_Dream_%28high_quality%29.ogv.360p.webm',
        'type' => 'video/webm',
        'poster' => 'http://upload.wikimedia.org/wikipedia/commons/thumb/9/90/Elephants_Dream_s1_proog.jpg/' .
            '800px-Elephants_Dream_s1_proog.jpg'
    ]
];?>
<?= dosamigos\gallery\Carousel::widget([
    'items' => $items, 'json' => true,
    'templateOptions' => ['id'=>'gallery_1'],
    'clientOptions' => ['container'=>'#gallery_1'],
    'options' => ['id'=>'gallery_1'],
]);

<?= dosamigos\gallery\Carousel::widget([
    'items' => $items, 'json' => true,
    'templateOptions' => ['id'=>'gallery_2'],
    'clientOptions' => ['container'=>'#gallery_2'],
    'options' => ['id'=>'gallery_2'],
]);
?>  
```

### You can access to different instances in JS now

```
blueimp_galleries['gallery_1'].initSlides();
blueimp_galleries['gallery_1'].next();
```



## Testing

```bash
$ ./vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [All Contributors](https://github.com/2amigos/yii2-selectize-widget/graphs/contributors)

## License

The BSD License (BSD). Please see [License File](LICENSE.md) for more information.

<blockquote>
    <a href="http://www.2amigos.us"><img src="http://www.gravatar.com/avatar/55363394d72945ff7ed312556ec041e0.png"></a><br>
    <i>web, mobile development & design</i><br>
    <i><a href="http://www.2amigos.us">www.2amigos.us</a></i>
</blockquote>
