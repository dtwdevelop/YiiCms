<div class="form-horizontal col-md-5 well ">
<?php if(Yii::$app->session->hasFlash('Success')): ?>
<div class="alert alert-success" role="alert">Please check you mail</div>
<?php endif; ?>
<?php if(Yii::$app->session->hasFlash('Incorrect')): ?>
<div class="alert alert-warning" role="alert">Email incorrect</div>
<?php endif; ?>
<div class="form-horizontal center-block form-group">
<?php
use yii\helpers\Html;
echo Html::beginForm();
echo Html::label("email");
echo Html::textInput('email');
echo Html::submitButton('restore',['class'=>'btn btn-primary']);
echo Html::endForm();
        
?>
</div>
</div>
   
