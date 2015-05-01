<?php
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
use yii\widgets\LinkSorter;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\StarRating;
?>

<?php Pjax::begin(); ?>

<div class="col-md-10">
    <?php if(isset($sorter)){ echo LinkSorter::widget(['sort'=>$sorter,'options' => ['class' => 'btn-group  nav nav-pills','style'=>'margin:5px']]); }?> 
     <div class="media well">
              
   
 <?php foreach ($model as $cat): ?>
    <div class="media-body pull-left">
     <div class="media-heading "><?= $cat['title'] ?></div>
     <a class="media-left fancy"  data-pjax="0"  rel="group"  href="<?= Url::to(['/uploads/big/'.$cat['big_foto']]) ?>">
                   <?= Html::img('/uploads/small/'.$cat['big_small'], ['width'=>'200','class'=>'img-thumbnail']); ?>
                  </a>
     
     <?php  \Yii::$app->user->isGuest? $value=true:$value=false ?>
     <?=  StarRating::widget([
    'name' => 'rating',
     'value' => $rating->Vote($cat['file_id']),
     'pluginOptions' => ['size' => 'xm', 'showClear'=>false,'showCaption'=>false],
      'pluginEvents'=>[
          "rating.change" => "function(event, value) { $.getJSON( '/gallery/rating',{star:value,gallery:".$cat['file_id']."}, function( data ) {});}",
      ],
       'options' => [
          'disabled'=>$value,
       ],
]);?>
        <div><?= \Yii::$app->formatter->format($cat['created'], 'date') ?></div>
     </div>   
<?php endforeach; ?>
   
               
     </div>
    </div>
<?= LinkPager::widget(['pagination' => $pages]) ?>
<?php Pjax::end(); ?>
