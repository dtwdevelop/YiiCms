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

    <?= $form->field($model, 'q')->textInput();  ?>

    <?= $form->field($model, 'type')->dropDownList($model->getType(),['prompt' => 'Select']) ?>
<div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary', 'name' => 'yes']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    </div>

<div class="well">
    <div><?php if($rezult !== null){
        echo "<h3>Found</h3>";
    foreach ($rezult as $data){
   
        if($model->type === '1'){
            if(isset($data->se_id)){
              
                 echo $this->render('profile',['data'=>$data]);
            }
           
             
        }
        if($model->type === '2'){
            
           if(isset($data->se_id)){
             
            echo $this->render('article',['data'=>$data]);
            }
             
        }
         if($model->type === '3'){
            
           if(isset($data->se_id)){
              echo $this->render('media',['data'=>$data]);
            }
             
        }
      }
  }
   
?></div>
   <?php Pjax::end(); ?> 
</div>
 