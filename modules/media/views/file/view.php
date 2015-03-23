<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\modules\media\models\Files */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fotos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="files-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->file_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'file_id',
            'media_id',
            'title',
            'big_foto',
            [    
           
            'label' => 'Foto',
            'format' => 'html',
            'value' => Html::img('/'.Yii::$app->params['smallFoto'].$model->big_small, ['width'=>'100']),
           ],
           
            'topic',
            'url:url',
            'meta',
            'meta_tags',
            'show',
            'created',
            'like',
            'view',
        ],
    ]) ?>
<?php Modal::begin([
    'size'=>Modal::SIZE_LARGE,
    'header' => '<h2>'.$model->title.'</h2>',
    'toggleButton' => ['label' => 'BigFoto'],
    'footer'=>'<p>'.$model->created.'</p>'
]);

 echo Html::img('/'.Yii::$app->params['bigFoto'].$model->big_foto,['width'=>'600']);

Modal::end(); ?>
</div>
