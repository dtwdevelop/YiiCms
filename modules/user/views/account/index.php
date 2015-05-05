<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Accounts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index col-md-10 well">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
           <?= Html::a(Yii::t('app', '{modelClass}  Users', [
    'modelClass' => '<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>',
]), ['/user/profile/index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', '<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Create {modelClass}', [
    'modelClass' => 'Accounts',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
      //  'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           

            'profile_id',
            'user_id',
            'name',
            'email:email',
            'role',
           
             'ban',
             'created',
           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
