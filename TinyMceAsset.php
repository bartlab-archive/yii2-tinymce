<?php

namespace maybeworks\tinymce;

use yii\web\AssetBundle;

class TinyMceAsset extends AssetBundle {
    public $sourcePath = '@bower/tinymce';

    public $js = [
        'tinymce.min.js',
    ];
} 