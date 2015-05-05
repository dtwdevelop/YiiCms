<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\media\models\SearchFile */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Files');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="files-index well">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Add  {modelClass}', [
    'modelClass' => 'Foto',
]), ['create'], ['class' => 'btn btn-success']) ?>
          <?= Html::a(Yii::t('app', 'Categories {modelClass}', [
    'modelClass' => 'List',
]), ['/media/media/index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
//        
        'columns' => [
             [
            'class' => 'yii\grid\CheckboxColumn',
            // you may configure additional properties here
        ],
            ['class' => 'yii\grid\SerialColumn'],

            'file_id',
            'media_id',
            'title',
           
          //  'big_small',
            // 'topic',
            // 'url:url',
            // 'meta',
            // 'meta_tags',
            // 'show',
            // 'created',
            // 'like',
            // 'view',
            [
              'attribute'=>'big_small',
            'label' => 'foto',
            'format' => 'html',
            'value' =>function($model){ return Html::img('/'.Yii::$app->params['smallFoto'].$model->big_small, ['width'=>'100']);}
           ],
           

            ['class' => 'yii\grid\ActionColumn',
              'template'=>'{view}  {delete}',
            // 'buttons'=>[]
                ],
        ],
    ]); ?>

</div>
