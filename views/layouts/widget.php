<?php
use kartik\nav\NavX;
use app\widzets\tags\TagcloudWidget;
use app\widzets\last\Last10Widget;
use yii\widgets\Pjax;
?>

      <div class="panel " >
               <div class=" panel3 panel-heading ">Menu</div>
                <div class="panel-body">
 

 <?= NavX::widget([
    'items' => [
      
        [
          'label' => 'Categories', 
          'url' => ['/categories/index'],
          'items'=>app\modules\article\models\Categories::createMenu(0),
          
                 
        ],
        
       
    ],
]);
                ?>
  
               </div>
</div>

 <div class="panel " >
      <?= Last10Widget::widget(['title' => 'Last News']) ?>
       </div>
                    
     <?= TagcloudWidget::widget(['title' => 'Tags']) ?>


