<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
use kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form  ">

    <?php $form = ActiveForm::begin(); ?>
     <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
    'language' => 'en',
    'data' => $category->getCategoryList(false),
    'options' => ['placeholder' => 'Parent Category ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]); ?>
    <?php // $form->field($model, 'category_id')->dropDownList($category->getCategoryList(false), ['prompt' => 'Parent Category']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'meta')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'topic')->textarea(['rows' => 8,'class'=>'editor']) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>

    

    <?= $form->field($model, 'meta_tags')->textInput(['maxlength' => 255,'class'=>'tags']) ?>

    <?= $form->field($model, 'show')->widget(SwitchInput::classname(), []); ?>

   

    <?= $form->field($model, 'view')->widget(SwitchInput::classname(), [])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
