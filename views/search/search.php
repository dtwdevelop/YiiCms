<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii\jui\AutoComplete;
/* @var $this yii\web\View */
?>
<?php Pjax::begin(); ?>
<div class="site-login well ">
    
 <?php $form = ActiveForm::begin([
        'id' => 'login-form',
         'method'=>'get',
          'action'=>['/search/search'],
        'options' => ['class' => 'form-horizontal','data-pjax'=>'1'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'q')->widget(AutoComplete::classname(), [
    'clientOptions' => [
        'source' => [$rezult],
    ],
])  ?>

    <?= $form->field($model, 'type')->dropDownList($model->getType(),['prompt' => 'Select']) ?>
<div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary', 'name' => 'yes']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
<h3>Found</h3>
<div class="well">
    <div><?php if($rezult !== null){
        
    foreach ($rezult as $data){
   
        if($model->type === '1'){
            if(isset($data->se_id)){
                echo Html::a($data->title, ['/user/account/view','id'=>$data->se_id]);
                 echo Html::tag('br');
            }
           
             
        }
        if($model->type === '2'){
            
           if(isset($data->se_id)){
              echo Html::a($data->title, ['/categories/'.$data->se_id],['data-pjax'=>0]);
              echo Html::tag('br');
            }
             
        }
         if($model->type === '3'){
            
           if(isset($data->se_id)){
              echo Html::a($data->title, ['/gallery/page?category='.$data->se_id],['data-pjax'=>0]);
              echo Html::tag('br');
            }
             
        }
      }
  }
   
?></div>
   <?php Pjax::end(); ?> 
</div>
 