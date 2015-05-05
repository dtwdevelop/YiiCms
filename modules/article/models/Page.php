<?php

namespace app\modules\article\models;

use Yii;
use app\modules\article\models\Tags;
use app\modules\article\models\Categories;
use yii\helpers\Url;
/**
 * This is the model class for table "in_page".
 *
 * @property integer $page_id
 * @property integer $category_id
 * @property string $title
 * @property string $topic
 * @property string $url
 * @property string $meta
 * @property string $meta_tags
 * @property integer $show
 * @property string $created
 * @property string $update
 * @property string $view
 */
use yii\db\Expression;
class Page extends \yii\db\ActiveRecord
{
    public $oldTag;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_page';
    }
    public function beforeValidate() {
        if($this->isNewRecord){
           $this->created =  new Expression('NOW()');
            $this->update =  new Expression('NOW()');
            $this->view=1;
          
           $this->url='http://';
        }
        else{
         $this->url = Url::base(true).'/categories/'.$this->page_id;
        }
        return parent::beforeValidate();
    }
     public function afterFind() {
       parent::afterFind();
      $this->oldTag = $this->meta_tags;
        
       
    }
    
   
    public function afterDelete() {
        $tag = new Tags();
        $tag->updateFrequency($this->meta_tags,'');
        return parent::afterDelete();
    }
     public function afterSave($insert,$changedAttributes) {
         
        parent::afterSave($insert,$changedAttributes);
         
          
           
        
       
       $tag = new Tags();
       
       $tag->updateFrequency($this->oldTag, $this->meta_tags);
      // $tags="sport,go";
       //$tag->updateFrequency( $tags,  $tags);

        
    }
    
    
    public static function findCategory($parent){
         
       $cat = Categories::findOne(['category_id'=>$parent]);
       return $cat->title;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'topic', 'url', 'meta', 'meta_tags', 'show',  'view'], 'required'],
            [['category_id', 'show', 'view'], 'integer'],
            [['created', 'update','url'], 'safe'],
            [['title', 'topic', 'url', 'meta', 'meta_tags'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'page_id' => Yii::t('app', 'Page ID'),
            'category_id' => Yii::t('app', 'Category'),
            'title' => Yii::t('app', 'Title'),
            'topic' => Yii::t('app', 'Topic'),
            'url' => Yii::t('app', 'Url'),
            'meta' => Yii::t('app', 'Meta'),
            'meta_tags' => Yii::t('app', 'Meta Tags'),
            'show' => Yii::t('app', 'Show'),
            'created' => Yii::t('app', 'Created'),
            'update' => Yii::t('app', 'Update'),
            'view' => Yii::t('app', 'View'),
        ];
    }
}
