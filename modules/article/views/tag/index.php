<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\article\models\SearchTags */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tags');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tags-index well">
    <p>
           
           <?= Html::a(Yii::t('app', 'Categories {modelClass}', [
    'modelClass' => '',
]), ['/article/categories/index'], ['class' => 'btn  btn-default']) ?>
                <?= Html::a(Yii::t('app', 'Pages {modelClass}', [
    'modelClass' => '',
]), ['/article/page/index'], ['class' => 'btn  btn-primary']) ?>
    </p>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'rate_id',
            'name',
            'fr',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
