<?php
use yii\bootstrap\Nav;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use app\assets\AppAsset;
use kartik\nav\NavX;
use app\modules\media\widzets\last\LastWidget;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
      <?= $this->render('menu'); ?>


        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
             
          
            <div class="row">
                <div class="col-md-3">
                    
                 <div class="panel " >
               <div class=" panel2 panel-heading ">OAuth Login</div>
                <div class="panel-body">
                    <?php if(Yii::$app->user->id): ?>
                    <h3>Welcome</h3>
                    
                    <?php else: ?>
                 <?= yii\authclient\widgets\AuthChoice::widget([
     'baseAuthUrl' => ['site/auth'],
     'popupMode' => true,
]) ?>        
     <?php endif; ?>
                </div>
</div>
  <?php if(isset($this->params['article'])): ?>
    <?= $this->render('widget'); ?>    
  <?php endif; ?>
     
                <div class="panel " >
               <div class="panel1 panel-heading ">Random</div>
                <div class="panel-body">
                <?= LastWidget::widget(['title' => 'Foto']) ?>
               
                </div>
                </div>
                     
                 </div>
            <div class="col-md-9"> <?= $content ?></div>
           
           
      
    </div>
        </div>
        
    </div>
        <button id="scroller" class="btn btn-default "><span class="glyphicon glyphicon-arrow-up"></span></button>

    <footer class="footer">
        <div class="container">
            
            <p class="pull-left">&copy; Sportimer <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
