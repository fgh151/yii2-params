<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use common\modules\params\Module;

/* @var $model common\modules\params\models\ParamsModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="app_params_settings-main-index">
    <h1><?= $model->paramsFilePath ?></h1>
    <?php $form = ActiveForm::begin();
        foreach ($model->attributes() as $attribute):
            echo $form->field($model,$attribute);
        endforeach;
        echo Html::submitButton(Module::t('app','Save settings'),['class'=>'btn btn-success']);
    ?>
    <?php ActiveForm::end()?>
</div>
