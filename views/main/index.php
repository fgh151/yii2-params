<?php

/* @var $model array */
?>

<?php foreach($model as $name => $file):?>
    <p><a href="<?=Yii::$app->urlManager->createUrl(['/params/main/edit', 'file' => $file])?>"><?=$name?></a> </p>
<?php endforeach;?>
