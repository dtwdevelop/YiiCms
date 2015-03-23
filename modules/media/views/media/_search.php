<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\media\models\SearchMedias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="medias-search col-md-5">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'media_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'picture') ?>

    <?= $form->field($model, 'topic') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'meta') ?>

    <?php // echo $form->field($model, 'meta_tags') ?>

    <?php // echo $form->field($model, 'show') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'view') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
