<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\SwitchInput;
/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-forms ">
   
    <?php $form = ActiveForm::begin(); ?>

   
    <?= $form->errorSummary($model); ?>
    <?=  $form->field($model2, 'username')->textInput(['maxlength' => 255]) ?> 
    <?=  $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'role')->dropDownList(['admin'=>'Admin','groupadmin'=>'GroupAdmin','user'=>'User'], ['prompt' => '-Roles']); ?>
    <?= $form->field($model2, 'password')->passwordInput(['maxlength' => 255]) ?>
     <?= $form->field($model, 'ban')->widget(SwitchInput::classname(), []); ?>
    <?= $form->field($model, 'active')->widget(SwitchInput::classname(), []); ?>

   
    

    
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
