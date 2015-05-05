<?php use yii\helpers\Url; ?>

<div class="panel2 panel-heading "><?= $title ?></div>
   <div class="panel-body">
       <?php if($model): ?>
               <?php foreach ($model as $val) : ?>
       <p><a  id="v<?= $val->page_id ?>" href="<?= Url::toRoute('/categories/'.$val->page_id); ?>"><?=$val->title ?></a></p>
     <?php $this->registerJs('$("#v'.$val->page_id.'").click(function(){$.get("/categories/'.$val->page_id.'?_pjax=1",function(data){$("#p").html(data)});return false});', \yii\web\View::POS_READY);?>
               <?php endforeach; ?>
               <?php  endif;?>
               
  </div>

