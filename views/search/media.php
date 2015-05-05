<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

 <div class="panel ">
               <div class="panel2 panel-heading "> <?=  $data->title ?>  </div>
                <div class="panel-body">
              
                 <?= Html::img('/uploads/'.$data->picture, ['width'=>'200','class'=>'img-responsive']); ?>

                </div>

              
               <div class="panel-footer">
                  <div><a class="btn btn-default btn-sm" data-pjax="0" href="<?=Url::to('/gallery/page?category='.$data->se_id )?>">More ..</a></div>

               </div>
              
               
             
                
     </div>

