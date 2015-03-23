<?php

namespace app\modules\media\models;

use Yii;

/**
 * This is the model class for table "in_files".
 *
 * @property integer $file_id
 * @property integer $media_id
 * @property string $title
 * @property string $big_foto
 * @property string $big_small
 * @property string $topic
 * @property string $url
 * @property string $meta
 * @property string $meta_tags
 * @property integer $show
 * @property string $created
 * @property string $like
 * @property string $view
 */
use yii\db\Expression;
class Files extends \yii\db\ActiveRecord
{
    public $file;
    
    /**
     * @inheritdoc
     */
    public function beforeValidate() {
        $this->created =  new Expression('NOW()');
        
        $this->view=1;
        $this->url = $this->title;
        $this->like = 1;
        
        
        return parent::beforeValidate();
    }
    public static function tableName()
    {
        return 'in_files';
    }
    
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['media_id', 'title',  'topic', 'url', 'meta', 'meta_tags', 'show', 'created', 'like', 'view'], 'required'],
            [['media_id', 'show', 'like', 'view'], 'integer'],
             [['file'],'file'],
            [['created','big_foto', 'big_small',], 'safe'],
            [['title', 'big_foto', 'big_small', 'topic', 'url', 'meta', 'meta_tags'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file_id' => Yii::t('app', 'File ID'),
            'media_id' => Yii::t('app', 'Media ID'),
            'title' => Yii::t('app', 'Title'),
            'big_foto' => Yii::t('app', 'Big Foto'),
            'big_small' => Yii::t('app', 'Big Small'),
            'topic' => Yii::t('app', 'Topic'),
            'url' => Yii::t('app', 'Url'),
            'meta' => Yii::t('app', 'Meta'),
            'meta_tags' => Yii::t('app', 'Meta Tags'),
            'show' => Yii::t('app', 'Show'),
            'created' => Yii::t('app', 'Created'),
            'like' => Yii::t('app', 'Like'),
            'view' => Yii::t('app', 'View'),
        ];
    }
}
