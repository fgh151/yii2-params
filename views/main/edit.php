<?php

use fgh151\modules\params\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model \fgh151\modules\params\models\ParamsModel */
/* @var $form yii\widgets\ActiveForm */
/* @var $file string */
?>

<div class="app_params_settings-main-index">
    <h1><?= $model->paramsFilePath ?></h1>
    <?php echo Html::a(Module::t('app', 'Add'), ['add', 'file' => $file], ['class' => 'btn btn-success']); ?>
    <?php $form = ActiveForm::begin();
    foreach ($model->attributes() as $attribute):
        echo $form->field($model, $attribute, [
            'template' => ' {label}
                <div class="input-group">
                     {input}
                     <a href="'.Yii::$app->urlManager->createUrl(['params/main/delete', 'file' => $file, 'key' => $attribute]).'" class="input-group-addon">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </div>{error}'
        ]);

    endforeach;
    echo Html::submitButton(Module::t('app', 'Save settings'), ['class' => 'btn btn-success']);
    ?>
    <?php ActiveForm::end() ?>
</div>
