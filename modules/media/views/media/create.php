<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\media\models\Medias */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Album',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Medias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
