<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\media\models\Files */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Files',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="files-create well">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'media' => $media,
    ]) ?>

</div>
