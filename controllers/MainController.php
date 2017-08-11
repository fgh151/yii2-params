<?php

namespace fgh151\modules\params\controllers;

use fgh151\modules\params\models\ParamsModel;
use fgh151\modules\params\Module;
use yii\base\DynamicModel;
use yii\web\Controller;

/**
 * Class MainController
 * @package fgh151\modules\params\controllers
 */
class MainController extends Controller
{

    /**
     * @var Module
     */
    public $module;

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', ['model' => $this->module->paramsFilePath]);
    }

    /**
     * @param string $file thet contain return []
     * @return string
     */
    public function actionEdit($file)
    {
        $model = new ParamsModel(['paramsFilePathAlias' => $file]);
        if ($model->load(\Yii::$app->request->post())) {
            $model->save();
        }
        return $this->render('edit', ['model' => $model, 'file' => $file]);
    }

    /**
     * add param action
     * @param string $file
     * @return string
     */
    public function actionAdd($file)
    {
        $model = new DynamicModel(['key', 'value']);
        $model->addRule('key', 'required');
        $model->addRule('value', 'string');
        if ($model->load(\Yii::$app->request->post())) {
            $params = new ParamsModel(['paramsFilePathAlias' => $file]);
            $key = $model->key;
            $params->$key = $model->value;
            $params->addRule($key, 'safe');
            $params->save();
            return $this->redirect(['edit', 'file' => $file]);
        }
        return $this->render('add', ['model' => $model, 'file' => $file]);
    }

    /**
     * @param $file
     * @param $key
     */
    public function actionDelete($file, $key)
    {
        $model = new ParamsModel(['paramsFilePathAlias' => $file]);
        $model->deleteKey($key);
        $model->save();

        $this->redirect(['edit', 'file' => $file]);
    }
}
