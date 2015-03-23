<?php

namespace app\modules\media\models;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "in_medias".
 *
 * @property integer $media_id
 * @property integer $user_id
 * @property string $title
 * @property string $picture
 * @property string $topic
 * @property string $url
 * @property string $meta
 * @property string $meta_tags
 * @property integer $show
 * @property string $created
 * @property string $view
 */
use yii\db\Expression;
class Medias extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_medias';
    }
    
    public function beforeValidate() {
        $this->created =  new Expression('NOW()');
        $this->user_id =1;
        $this->view=1;
        $this->url = $this->title;
        return parent::beforeValidate();
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
         
              
           $cat =   ArrayHelper::map($categories,'media_id','title');
         
         return  ArrayHelper::merge($category, $cat);
     }
           
        
      
     return $category;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'topic', 'url', 'meta', 'meta_tags', 'show', 'created', 'view'], 'required'],
            [['user_id', 'show', 'view'], 'integer'],
            [['created'], 'safe'],
            [['file'],'file'],
            [['title', 'topic', 'url', 'meta','picture', 'meta_tags'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'media_id' => Yii::t('app', 'Media ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'title' => Yii::t('app', 'Title'),
            'picture' => Yii::t('app', 'Foto'),
            'topic' => Yii::t('app', 'Topic'),
            'url' => Yii::t('app', 'Url'),
            'meta' => Yii::t('app', 'Meta'),
            'meta_tags' => Yii::t('app', 'Meta Tags'),
            'show' => Yii::t('app', 'Show'),
            'created' => Yii::t('app', 'Created'),
            'view' => Yii::t('app', 'View'),
        ];
    }
}
