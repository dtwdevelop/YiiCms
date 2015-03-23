<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\media\models\SearchMedias */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Media');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medias-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Category',
]), ['create'], ['class' => 'btn btn-success']) ?>
          <?= Html::a(Yii::t('app', 'Foto {modelClass}', [
    'modelClass' => 'Lists',
]), ['/media/file/index'], ['class' => 'btn btn-primary']) ?>
          <?= Html::a(Yii::t('app', 'Add {modelClass}', [
    'modelClass' => 'Foto',
]), ['/media/file/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'media_id',
           // 'user_id',
            'title',
//            'picture',
             [    
            'attribute'=>'picture',
            'label' => 'foto',
            'format' => 'html',
            'value' =>function($model){ return Html::img('/uploads/'.$model->picture, ['width'=>'100']);}
           ],
//            'topic',
            // 'url:url',
            // 'meta',
            // 'meta_tags',
            // 'show',
             'created',
            // 'view',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
