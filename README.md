yii2-tinymce
============

[TinyMCE WYSIWYG text editor plugin](http://www.tinymce.com/) widget for Yii PHP framework 2.0 

Features:
---------
* TinyMCE always the latest version, because loaded from the bower-asset/tinymce
* Automatically download the language file based on the current localization settings Yii
* Simple addition of their plug-ins and skins
* Correct client validation
* Other facilities

Installation
------------
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require "maybeworks/yii2-tinymce" "*"
```

or add

```json
"maybeworks/yii2-tinymce" : "*"
```

to the require section of your application's `composer.json` file.

Usage
-----

Basic usage

```
use maybeworks\tinymce\TinyMceWidget;

<?= $form->field($model, 'text')->widget(TinyMceWidget::className());?>

```

Editor config

```
use maybeworks\tinymce\TinyMceWidget;

<?= $form->field($model, 'text')->widget(
    TinyMceWidget::className(),
    clientOptions' => [
        'plugins' => [
            "code fullscreen",
            "media table contextmenu paste"
        ],
        'toolbar' => "undo redo | styleselect | bold italic | link image"
    ]
    );?>

```

Information
-----------
Documentation: [TinyMCE plugin site](http://www.tinymce.com/wiki.php/Configuration)


> [![MaybeWorks](http://maybe.works/img/mw_logo.png)](http://maybe.works)  
<i>Nothing is impossible, limit exists only in the minds of...</i>  
[maybe.works](http://maybe.works)