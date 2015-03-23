<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form ActiveForm */
?>
<div class="site-register well col-md-6">
    

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model); ?>
        <?= $form->field($model2, 'username') ?>
        <?= $form->field($model, 'name') ?>
       <?= $form->field($model, 'email') ?>
        <?= $form->field($model2, 'password')->input('password'); ?>
         <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-5">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
      
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-register -->
