<?php
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\widgets\LinkSorter;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php Pjax::begin(); ?>

<div class="col-md-10">
    <?php if(isset($sorter)){ echo LinkSorter::widget(['sort'=>$sorter]); }?> 
     <div class="media ">
              
   
 <?php foreach ($model as $cat): ?>
    <div class="media-body pull-left">
     <div class="media-heading "><?= $cat['title'] ?></div>
     <a class="media-left" data-pjax="0"  href="<?= Url::to(['/media/media/page','category'=>$cat['media_id']]) ?>">
                   <?= Html::img('/uploads/'.$cat['picture'], ['width'=>'150']); ?>
                  </a>
        <div><?= \Yii::$app->formatter->format($cat['created'], 'date') ?></div>
     </div>   
<?php endforeach; ?>
   
               
     </div>
    </div>
<?= LinkPager::widget(['pagination' => $pages]) ?>
<?php Pjax::end(); ?>
