<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Accounts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
           <?= Html::a(Yii::t('app', 'Users {modelClass}', [
    'modelClass' => '',
]), ['/user/profile/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Create {modelClass}', [
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
