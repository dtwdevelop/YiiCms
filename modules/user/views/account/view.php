<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = $model->name;

?>
<div class="profile-view col-md-8">
    <a class="btn btn-primary" href="<?php echo Url::to('/user/account/index.html'); ?>">Back</a>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->profile_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->profile_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
           <?= Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Accounts',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           
            'user_id',
            
            'name',
            'email:email',
            'role',
            'active',
            'ban',
            'created',
            
            'last_login',
            'online',
        ],
    ]) ?>

</div>
