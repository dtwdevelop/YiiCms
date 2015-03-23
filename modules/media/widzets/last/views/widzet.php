<div class="panel">
    <h4 class="<?= $class; ?>panel-heading"><?= $title; ?></h4>
    <div class="panel-body img-thumbnail">
<?php
use yii\helpers\Html;

echo Html::img('/'.\Yii::$app->params['smallFoto'].$foto, ['width'=>'150']);
?>
        </div>
</div>

