<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use kartik\popover\PopoverX;
use yii\helpers\Html;

            NavBar::begin([
                'brandLabel' => 'Sportimer',
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
                          ['label' => 'Categories', 'url' => ['/article/categories/index']],
                          
                             ['label' => ' Add page', 'url' => ['/article/page/create']],
                           ['label' => 'Media', 'url' => ['/media/media/index']],
                         
                        ]
                        ],
                   
                    ['label' => 'News', 'url' => ['/article/categories/list']],
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
