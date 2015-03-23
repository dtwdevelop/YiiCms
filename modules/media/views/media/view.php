<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\media\models\Medias */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Medias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medias-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
          <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Category',
]), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->media_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php // Html::img('/uploads/'.$model->picture, ['width'=>'100']) ?>
    <?= DetailView::widget([
        'model' => $model,
        
        'attributes' => [
            'media_id',
            'user_id',
            'title',
            
            [    
            'attribute'=>'picture',
            'label' => 'foto',
            'format' => 'html',
            'value' => Html::img('/uploads/'.$model->picture, ['width'=>'100']),
           ],
   
            'topic:html',
            'url:url',
            'meta',
            'meta_tags',
            'show',
            'created',
            'view',
        ],
    ]) ?>

</div>
