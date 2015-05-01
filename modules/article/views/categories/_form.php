<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-form ">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>
    <?php // $form->field($model, 'parent_id')->dropDownList($model->getCategoryList(), ['prompt' => 'Parent Category']); ?>
    <?= $form->field($model, 'parent_id')->widget(Select2::classname(), [
    'language' => 'en',
       
    'data' => $model->getCategoryList(),
    'options' => ['placeholder' => 'Parent Category ...'],
    'pluginOptions' => [
        'allowClear' => true,
         'size'=>'SMALL',
    ],
]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'about')->textarea(['rows' =>3,'class'=>'editor' ]) ?>

    <?php //= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'meta')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'meta_tags')->textInput(['maxlength' => 255,'class'=>'tags']) ?>

   

    <?= $form->field($model, 'show')->widget(SwitchInput::classname(), []); ?>

   

   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
