<?php

namespace app\modules\article\models;
use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\modules\article\models\Tags;
/**
 * This is the model class for table "in_category".
 *
 * @property integer $category_id
 * @property integer $parent_id
 * @property string $title
 * @property string $about
 * @property string $url
 * @property string $meta
 * @property string $meta_tags
 * @property integer $pos
 * @property integer $show
 * @property string $created
 * @property string $oldTag
 * @property string $view
 */
class Categories extends \yii\db\ActiveRecord
{
    public $oldTag;
    
    /**
     * @inheritdoc
     */
    public function  init() {
        
 }
    public static function tableName()
    {
        return 'in_category';
    }
    public function beforeValidate() {
       
        if($this->isNewRecord){
            $this->created =  new Expression('NOW()');
            $this->pos = 0;
            $this->view =1;
            
        }
        else{
            $this->created= $this->created;
            $this->view  =1;
        }
        $title = $this->title;
        $this->url = strtolower($title);
        return parent::beforeValidate();
    }
    /*
     * tag update
     */
    public function afterFind() {
       parent::afterFind();
      $this->oldTag = $this->meta_tags;
        
       
    }
    public function afterDelete() {
        $tag = new Tags();
        $tag->updateFrequency($this->meta_tags,'');
        return parent::afterDelete();
    }
    /**
     * 
     * @param  $tag update
     * @return type
     */
    public function afterSave($insert,$changedAttributes) {
        parent::afterSave($insert,$changedAttributes);
       $tag = new Tags();
       
       $tag->updateFrequency($this->oldTag, $this->meta_tags);
      // $tags="sport,go";
       //$tag->updateFrequency( $tags,  $tags);

        
    }
    
    public  function getCategoryList($root=true){
      if($root){
      $category = [0=>'Root'];
      
      }
      else{
          $category =[];
      }
      $categories =  $this->find()->asArray()->all();
      
     if($categories !== null){
         
              
           $cat =   ArrayHelper::map($categories,'category_id','title');
         
         return  ArrayHelper::merge($category, $cat);
     }
           
        
       return $category;
    
    }
    /**
     * 
     * @param type $id
     * @return find child
     */
    public static function findChildAll($id){
          $child =[];
          $data = Categories::findAll(['parent_id'=>$id]);
          if($data){
              foreach($data as $v){
                  if($v->show) {
                   $child[]  =  ['label'=>$v->title, 'url'=>['/categories/'.$v->category_id],'items'=> self::findChildAll($v->category_id)];
              }
                  
              }
          }
          
        return $child;
    }
  
   /**
    * create menu
    * @param type $parent child id
    * @return array
    */
    public static function createMenu($parent=0){
      
     $items=[];
     $child=[] ;
      $data = Categories::findAll(['parent_id'=>$parent]);
      if($data !== null){
      foreach ($data as $k => $v){
           if($v->show) {
           $child =  self::findChildAll($v->category_id);
          
           $items[] = ['label'=>$v->title,  'url'=>Url::to(['/categories/'.$v->category_id]),'items'=>$child];
           }
          }
                 
        }
     
   //   print_r($items);
       return $items;
   }
  
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'title', 'about', 'url', 'meta', 'meta_tags',  'created',], 'required'],
            [['parent_id', 'show', 'view'], 'integer'],
            [['created','pos', 'show','view'], 'safe'],
            [['title', 'about', 'url', 'meta', 'meta_tags',], 'string', 'max' => 255],
           //  [[ 'meta_tags'], 'tagsNormal']
        ];
    }
    
  public function tagsNormal($attribute, $params) {
        $this->meta_tags = Tags::arrayString(array_unique(Tags::stringArray($this->meta_tags)));
  }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => Yii::t('app', 'Category ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'title' => Yii::t('app', 'Title'),
            'about' => Yii::t('app', 'About'),
            'url' => Yii::t('app', 'Url'),
            'meta' => Yii::t('app', 'Meta'),
            'meta_tags' => Yii::t('app', 'Meta Tags'),
            'pos' => Yii::t('app', 'Pos'),
            'show' => Yii::t('app', 'Show'),
            'created' => Yii::t('app', 'Created'),
            'view' => Yii::t('app', 'View'),
        ];
    }
}
