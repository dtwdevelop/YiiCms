<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Page',
]), ['create'], ['class' => 'btn btn-success']) ?>
           <?= Html::a(Yii::t('app', 'Categories {modelClass}', [
    'modelClass' => '',
]), ['/categories/index'], ['class' => 'btn  btn-default']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'page_id',
            'category_id',
            'title',
            'topic',
            'url:url',
            // 'meta',
            // 'meta_tags',
            // 'show',
            // 'created',
            // 'update',
            // 'view',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
