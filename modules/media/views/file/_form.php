<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
/* @var $this yii\web\View */
/* @var $model app\modules\media\models\Files */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="files-form col-md-6 well">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->errorSummary($model); ?>
    
     <?= $form->field($model, 'media_id')->widget(Select2::classname(), [
    'language' => 'en',
    'data' => array_merge($media->getCategoryList(false)),
    'options' => ['placeholder' => 'Parent Category ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>
    <?php // $form->field($model, 'media_id')->dropDownList($media->getCategoryList(false), ['prompt' => 'Parent Category']); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>
     <?= $form->field($model, 'file')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*'],
          'pluginOptions' => [
       
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false
    ]
]); ?>
    <?php //  $form->field($model, 'file')->fileInput() ?>

   

    <?= $form->field($model, 'topic')->textInput(['maxlength' => 255]) ?>

   

    <?= $form->field($model, 'meta')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'meta_tags')->textInput(['maxlength' => 255]) ?>
     <?= $form->field($model, 'show')->widget(SwitchInput::classname(), []); ?>
   

   

   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
