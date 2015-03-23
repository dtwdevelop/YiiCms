<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\media\models\Medias */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Medias',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Medias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->media_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="medias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
