<?php use yii\helpers\Url; ?>

<div class="panel2 panel-heading "><?= $title ?></div>
   <div class="panel-body">
       <?php if($model): ?>
               <?php foreach ($model as $val) : ?>
       <p><a href="<?= Url::toRoute('/categories/'.$val->category_id); ?>"><?=$val->title ?></a></p>
      
               <?php endforeach; ?>
               <?php  endif;?>
               
  </div>

