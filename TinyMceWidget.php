<?php

namespace maybeworks\tinymce;

use maybeworks\tinymce\TinyMceAsset;
use maybeworks\tinymce\TinyMceCustomAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

class TinyMceWidget extends InputWidget {

    /**
     * the language to use. Defaults to false (autodetect)
     * @var string
     */
    public $language = false;

    /**
     * TinyMCE plugin config
     * @var array
     * @see http://www.tinymce.com/wiki.php/Configuration
     */
    public $clientOptions = [];

    /**
     * Default widget config
     * @var array
     */
    public $defaultOptions = [
        'rows' => 10
    ];

    /**
     * Default TinyMCE plugin config
     * @var array
     */
    public $defaultClientOptions = [
        'theme' => "modern",
        'plugins' => [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "template paste textcolor"
        ],
        'toolbar1' => "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        'toolbar2' => "print preview media | forecolor backcolor code",
        'image_advtab' => true,
//        'templates' => [
//            ['title' => 'Test template 1', 'content' => 'Test 1'],
//            ['title' => 'Test template 2', 'content' => 'Test 2']
//        ]
    ];

    public function init() {
        $this->options = array_merge($this->defaultOptions, $this->options);
        $this->clientOptions = array_merge($this->defaultClientOptions, $this->clientOptions);
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run() {
        if ($this->hasModel()) {
            echo Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textarea($this->name, $this->value, $this->options);
        }
        $this->registerClientScript();
    }

    protected function registerClientScript() {
        $view = $this->getView();

        TinyMceAsset::register($view);
        $tinyMceCustomAsset = TinyMceCustomAsset::register($view);

        $id = $this->options['id'];

        $this->clientOptions['selector'] = "#$id";

        if ($this->language === false) {
            $language = \Yii::$app->language;
        } else {
            $language = $this->language;
        }

        $lang_search = [
            explode('-', $language)[0],
            $language
        ];

        foreach ($lang_search as $l) {
            $path = '/langs/' . $l . '.js';
            if (is_file($tinyMceCustomAsset->basePath . $path)) {
                $this->clientOptions['language_url'] = $tinyMceCustomAsset->baseUrl . $path;
                $this->clientOptions['language'] = $l;
                break;
            }
        }

        if (is_dir($tinyMceCustomAsset->basePath . '/skins/custom')) {
            //            $this->clientOptions['skin_url'] = $tinyMceLangAsset->baseUrl.'/skins/custom';
            //            $this->clientOptions['skin'] = 'custom';
        }

        $options = Json::encode($this->clientOptions);

        $view->registerJs("tinymce.init($options);");
    }
}