<?php
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\widgets\LinkSorter;
use app\widzets\soc\SocialWidget;
use yii\helpers\Url;
use app\modules\article\models\Page;
?>



<div class="col-md-10">
 <?php foreach ($model as $cat): ?>
   
     <div class="panel ">
               <div class="panel2 panel-heading "><?= $cat['title'] ?></div>
                <div class="panel-body">
                   <?=  $cat['topic'] ; ?>
                    
                </div>
                 <div><a class="btn btn-default btn-sm" data-pjax="1" href="<?=Url::to('/article/categories/list')?>">Back ..</a></div>

              
               <div class="panel-footer">
               <?= \Yii::$app->formatter->format($cat['created'], 'date') ?>
                    <em>Category: <?= Page::findCategory($cat['category_id']) ?></em>
               </div>
              
                 <div><?= SocialWidget::widget(); ?></div>
             
                
     </div>
<?php endforeach; ?>

<?= LinkPager::widget(['pagination' => $pages]) ?>
</div>



