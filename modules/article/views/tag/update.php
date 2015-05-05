<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\article\models\Tags */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Tags',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->rate_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tags-update well">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
