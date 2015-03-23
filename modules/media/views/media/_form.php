<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\modules\media\models\Medias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="medias-form col-sm-6 well">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

   
    <?=  $form->errorSummary($model); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => 255,]) ?>
   <?php  echo $form->field($model, 'file')->widget(FileInput::classname(), 
    [ 'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
       
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false
    ]
        
        ]); ?>
    
    <?php //  $form->field($model, 'file')->fileInput() ?>

    <?= $form->field($model, 'topic')->textarea(['rows' => 4,'class'=>"editor"]) ?>

    

    <?= $form->field($model, 'meta')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'meta_tags')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'show')->widget(SwitchInput::classname(), []); ?>

   

   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
