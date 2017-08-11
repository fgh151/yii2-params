<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use \fgh151\modules\params\Module;

/**
 * Created by PhpStorm.
 * User: fgorsky
 * Date: 11.08.17
 * Time: 11:43
 */
?>
<?php $form = ActiveForm::begin();?>

<h1><?=Module::t('app', 'Add param to').' '.$file?></h1>

<?= $form->field($model, 'key');?>
<?= $form->field($model, 'value');?>

<?=Html::submitButton(Module::t('app','Save'),['class'=>'btn btn-success']);?>

<?php ActiveForm::end()?>