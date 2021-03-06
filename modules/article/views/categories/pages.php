<?php
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\widgets\LinkSorter;
use app\widzets\soc\SocialWidget;
use yii\helpers\Url;
use app\modules\article\models\Page;
?>

<?php Pjax::begin(['id'=>'p']); ?>

<div class="col-md-10">
    <?php if(isset($sorter)){ echo LinkSorter::widget(['sort'=>$sorter,'options' => ['class' => 'btn-group btn-link  nav nav-pills','style'=>'margin:5px']]); }?> 
 <?php foreach ($model as $cat): ?>
   
     <div class="panel ">
               <div class="panel2 panel-heading "><?= $cat['title'] ?></div>
                <div class="panel-body">
                   <?=  $cat['topic'] ; ?>
                    
                </div>
               <?php if($widget != true): ?>
               <div><a class="btn btn-default btn-sm" data-pjax="1" href="<?=Url::to('/categories/'.$cat['page_id'])?>">Read more ..</a></div>
               <?php else: ?>
               <div><a class="btn btn-default btn-sm" data-pjax="1" href="<?=Url::to('/article/categories/list')?>">Back ..</a></div>

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

</div>
<?php Pjax::end(); ?>
