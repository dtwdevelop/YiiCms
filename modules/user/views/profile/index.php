<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index well">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
           <?= Html::a(Yii::t('app', ' {modelClass}', [
    'modelClass' => '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Accounts ',
]), ['account/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', '{modelClass}', [
    'modelClass' => '<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Ad Account',
]), ['account/create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
   
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
             ['class' => 'yii\grid\CheckboxColumn'],   
             'id',
            
            'username',
            'profile.email',
            
            [
    'attribute' => 'Accounts',
    'format' => 'raw',
    'value' => function ($model,$url) {                      
            return  '<a href='.Url::toRoute(['account/view', 'id' => $model->profile->profile_id]).">Account</a>";
    },
],

            
            
           
           
            ['class' => 'yii\grid\ActionColumn',
              
             ],
        ],
    ]); ?>

</div>
