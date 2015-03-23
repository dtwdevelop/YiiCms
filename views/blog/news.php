<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;


foreach ($data as $val){
    echo Html::encode($val->title);
    echo Html::encode($val->post);
}
?>
<br/>
<?php echo \Yii::t('app', 'Smile');?>


<?= LinkPager::widget(['pagination' => $pages]) ?>


