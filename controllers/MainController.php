<?php

namespace fgh151\modules\params\controllers;

use fgh151\modules\params\ParamsModule;
use yii\web\Controller;
use fgh151\modules\params\models\ParamsModel;

/**
 * Class MainController
 * @package fgh151\modules\params\controllers
 */
class MainController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index',['model'=>$this->module->paramsFilePath]);
    }

    /**
     * @param string $file thet contain return []
     * @return string
     */
    public function actionEdit($file)
    {
        $model = new ParamsModel(['paramsFilePathAlias' =>  $file]);
        if($model->load(\Yii::$app->request->post()))
        {
            $model->save();
        }
        return $this->render('edit',['model'=>$model]);
    }
}
