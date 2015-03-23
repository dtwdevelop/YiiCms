<?php
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\widgets\LinkSorter;
use app\widzets\soc\SocialWidget;
use yii\helpers\Url;
use app\models\Page;
?>

<?php Pjax::begin(); ?>

<div class="col-md-10">
    <?php if(isset($sorter)){ echo LinkSorter::widget(['sort'=>$sorter]); }?> 
 <?php foreach ($model as $cat): ?>
   
     <div class="panel ">
               <div class="panel2 panel-heading "><?= $cat['title'] ?></div>
                <div class="panel-body">
                   <?=  $cat['topic'] ; ?>
                    
                </div>
               <?php if($widget != true): ?>
               <div><a class="btn btn-default btn-sm" data-pjax="0" href="<?=Url::to('/categories/'.$cat['page_id'])?>">Read more ..</a></div>
               <?php else: ?>
               <div><a class="btn btn-default btn-sm" data-pjax="0" href="<?=Url::to('/categories/list')?>">Back ..</a></div>

               <?php endif;?>
              
               <div class="panel-footer">
               <?= \Yii::$app->formatter->format($cat['created'], 'date') ?>
                    <em>Category: <?= Page::findCategory($cat['category_id']) ?></em>
               </div>
               <?php if($widget): ?>
                 <div><?= SocialWidget::widget(); ?></div>
               <?php endif;?>
                
     </div>
<?php endforeach; ?>

<?= LinkPager::widget(['pagination' => $pages]) ?>
</div>
<?php Pjax::end(); ?>
