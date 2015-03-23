<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use app\assets\AppAsset;
use kartik\nav\NavX;
use app\modules\media\widzets\last\LastWidget;
use app\widzets\tags\TagcloudWidget;
use kartik\popover\PopoverX;
use app\widzets\last\Last10Widget;

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
        <?php
            NavBar::begin([
                'brandLabel' => 'Project X',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            
    $userPopover = '<li class="dropdown"><div class="navbar-form">' . PopoverX::widget([
    'header' => 'Account',
    'placement' => PopoverX::ALIGN_BOTTOM_LEFT,
    'size' => 'sm',
    'content' =>Nav::widget(
    ['items' =>
        [
            Yii::$app->user->isGuest ?
             
            ['label' => 'Login in', 'url' => ['/site/login']]:
              ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
             ['label' => 'Sign up', 'url' => ['/site/register']],
            ['label' => 'Forgot password?','url' =>  ['/site/forgot']],
            
           
        ],
        ]),
        
   // 'footer' => Html::button('Logout', ['class'=>'btn btn-sm btn-default']),
    'toggleButton' => [
        'label' => 'Account' . Html::tag('span', '', ['class' => 'glyphicon  glyphicon-user', 'style' => 'padding-left: 10px']),
        'class'=>'btn '
    ]
]) . '</div></li>';
    

            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    
                    ['label' => 'Admin', 'url' => ['#'],'visible' =>!Yii::$app->user->isGuest,
                        'items'=>[
                         
                          ['label' => 'Accounts', 'url' => ['/user/account/index']],
                          ['label' => 'Categories', 'url' => ['/categories/index']],
                           ['label' => 'Media', 'url' => ['/media/media/index']],
                         
                        ]
                        ],
                   
                    ['label' => 'News', 'url' => ['/categories/list']],
                    ['label' => 'Gallery', 'url' => ['/media/media/list']],
                    ['label' => 'Profile', 'url' => ['/site/profile'] , 'visible' =>!Yii::$app->user->isGuest],
                    ['label' => 'Search', 'url' => ['/search/search']],
                    
                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                    ['label' => 'Api', 'url' => ['/apis/']],
                     '<li>' . $userPopover . '</li>',
                    
                  
                        
                ],
            ]);
         
            NavBar::end();
        ?>


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
                <div class="panel " >
               <div class=" panel1 panel-heading ">Menu</div>
                <div class="panel-body">
 

 <?= NavX::widget([
    'items' => [
        [
            'label' => 'Home',
            'url' => ['/site/index'],
            'linkOptions' => [],
            
         
        ],
        
       
      
        
       
    // app\models\Categories::createMenu(0),
        [
          'label' => 'Categories', 
          'url' => ['/categories/index'],
          'items'=>app\models\Categories::createMenu(0),
          
                 
        ],
        
       
    ],
]);
                ?>
  
               </div>
</div>
      <div class="panel " >
      <?= Last10Widget::widget(['title' => 'Last News']) ?>
       </div>
                    
                 <?= TagcloudWidget::widget(['title' => 'Tags']) ?>
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
            
            <p class="pull-left">&copy; Project X <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
