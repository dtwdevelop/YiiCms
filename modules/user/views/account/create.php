<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Account',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accounts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-creates col-md-10 well">
 
    <h1><?= Html::encode($this->title) ?></h1>

    <?=  $this->render('_form', [
        'model' => $model,
        'model2' => $model2
           
    ]) ?>

</div>

