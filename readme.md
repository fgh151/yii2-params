Русская документация скоро будет доступна доступна на сайте [OpenItStudio](https://openitstudio.ru)

Yii2 params files management utility
====================================

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist fgh151/yii2-params "*"
```

or add

```
"fgh151/yii2-params": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply add it in your config by  :

```php
        'modules' => [
               ...
               'params' => [
                   'class' => 'fgh151\modules\params\Module',
                   'paramsFilePath' => [
                       'Common params' => '@common/config/params.php',
                       'Backend Params' => '@backend/config/params.php',
                       'Frontend Params' => '@frontend/config/params.php',
                   ]
               ]
           ],
```php

add to paramsFilePath array names of files and path to them

RBAC
----

You can use RBAC with module. Simply add it in your config:

```php
        'modules'    => [
             'params' => [
                'class' => 'fgh151\modules\params\Module',
                'paramsFilePath' => [
                    'Common params' => '@common/config/params.php',
                    'Backend Params' => '@backend/config/params.php',
                    'Frontend Params' => '@frontend/config/params.php',
                ],
                'as access' => [
                    'class' => 'yii\filters\AccessControl',
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['admin'],
                        ]
                    ]
                ]
             ]
            ...
        ],
```


Usage
-----

Pretty Url's ```/params```

No pretty Url's ```index.php?r=params```
