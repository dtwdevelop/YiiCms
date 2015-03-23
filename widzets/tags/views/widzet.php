<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>
  
  <div class="panel " >
  <div class="panel2 panel-heading "><?= $title ?></div>
   <div class="panel-body">
       <?php if($tags): ?>
         <?php foreach($tags as $tag=>$weight): ?>
<a href="<?=  Url::toRoute(['/categories/list',  'tag'=>$tag]);?>" >
    <span style="font-size:<?= $weight ;?>pt;">
   <?=  $tag; ?>
</span>
  </a>
                     
<?php endforeach;?>
       <?php endif;?>
    </div>
   </div>             


