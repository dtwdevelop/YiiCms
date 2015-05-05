<?php
use yii\helpers\Url;
?>

 <div class="panel ">
               <div class="panel2 panel-heading ">  </div>
                <div class="panel-body">
                 <?=  $data->title ?>
                    
                </div>

              
               <div class="panel-footer">
                  <div><a class="btn btn-default btn-sm" data-pjax="1" href="<?=Url::to(['/user/account/view','id'=>$data->se_id ])?>">More ..</a></div>

               </div>
              
               
             
                
     </div>



