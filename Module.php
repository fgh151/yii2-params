<?php

namespace fgh151\modules\params;

use Yii;

/**
 * Class Module
 * @package fgh151\modules\params
 */
class Module extends \yii\base\Module
{
    public $defaultRoute = 'main';
    
    public $controllerNamespace = 'fgh151\modules\params\controllers';
    
    public $paramsFilePath = [];

    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    protected function registerTranslations()
    {
        Yii::$app->i18n->translations['params/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@eapanel/params/messages',
            'fileMap' => [
                'params/system' => 'system.php',
                'params/app' => 'app.php'
            ],
        ];
    }

    /**
     * @param $category
     * @param $message
     * @param array $params
     * @param null $language
     * @return string
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('params/' . $category, $message, $params, $language);
    }
}
