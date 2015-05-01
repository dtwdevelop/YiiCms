<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\widgets\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Categories',
]), ['create'], ['class' => 'btn btn-success']) ?>
         <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Page',
]), ['/article/page/create'], ['class' => 'btn btn-primary']) ?>
  <?= Html::a(Yii::t('app', 'Pages {modelClass}', [
    'modelClass' => 'List',
]), ['/article/page/index'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
          
            'category_id',
            'parent_id',
            'title',
            'about',
            'url:url',
            // 'meta',
            // 'meta_tags',
            // 'pos',
             'show',
            // 'created',
              ['attribute'=>'created',
            'format' => ['date', 'php:d-M-Y'],
           // 'value' =>function($model){ return date('d-M-Y',strtotime($model->created));},
  
     'filter'=>DatePicker::widget([
    'name' => 'check_issue_date', 
    'value' => date('d-M-Y', strtotime('now')),
    'options' => ['placeholder' => 'Select date'],
    'pluginOptions' => [
        'format' => 'd-M-Y',
        'todayHighlight' => true
    ]
])
                ],
            // 'view',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
