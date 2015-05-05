<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>
  
  <div class="panel " >
  <div class="panel2 panel-heading "><?= $title ?></div>
   <div class="panel-body">
       <?php if($tags): ?>
         <?php foreach($tags as $tag=>$weight): ?>
<a id="t<?=$tag?>" href="<?=  Url::toRoute(['/article/categories/list',  'tag'=>$tag]);?>" >
    <span style="font-size:<?= $weight ;?>pt;">
   <?=  $tag; ?>
</span>
  </a>
 <?php $this->registerJs('$("#t'.$tag.'").click(function(){$.get("/article/categories/list/?tag='.$tag.'",function(data){$("#p").html(data)});return false});', \yii\web\View::POS_READY);?>
                 
<?php endforeach;?>
       <?php endif;?>
    </div>
   </div>             


