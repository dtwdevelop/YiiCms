<?php

namespace app\modules\user\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use app\modules\user\models\behaviors\DateTimeStampBehavior;
/**
 * This is the model class for table "in_profile".
 *
 * @property integer $profile_id
 * @property integer $user_id
 * @property string $name
 * @property string $email
 * @property string $role
 * @property integer $active
 * @property integer $ban
 * @property string $created
 * @property string $update
 * @property string $last_login
 * @property integer $online
 * *@property string $verifyCode
 */

class Profile extends \yii\db\ActiveRecord 
{
    /**
     * @inheritdoc
     */
    public $verifyCode;
    public static function tableName()
    {
        return 'in_profile';
    }
      public function getUsers()
    {
        
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
   
    
    
    public  function beforeValidate() {
        
        if($this->isNewRecord){

        }
        return parent::beforeValidate();
    }
   
            
    public function beforeSave($insert)
{
     
    if ($this->isNewRecord)
    {
       
        $command = static::getDb()->createCommand("select max(id) as id from in_users")->queryAll();
        if($command !== null){
            $this->user_id  = $command[0]['id'];
        }
        else{
          $command2 = static::getDb()->createCommand("select id as id from in_users")->queryAll();
          $this->user_id  = $command2[0]['id'];
        }
        
         if($this->role == null){
            $this->role='user';
        }
         if($this->active == null){
            $this->active=0;
        }
        
//        $this->created =new Expression('NOW()');
//        $this->update =new Expression('NOW()');
        $this->last_login =new Expression('NOW()');
        $this->online=1;
        $this->ban=0;
        
    }
    else{
//        $this->created =new Expression('NOW()');
//        $this->update =new Expression('NOW()');
        $this->last_login =new Expression('NOW()');
    }
   
 
    return parent::beforeSave($insert);
}

public function behaviors()
    {
        return [
            [
                'class' => DateTimeStampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created', 'update'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update'],
                ],
            ],
        ];
    }

public function contact($email,$link)
    {
         
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom($this->email)
                ->setSubject("Activation")
                ->setTextBody("Please click to active you account  $link thanks")
                ->send();

    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
         
        return [
            [[ 'name', 'email' ], 'required'],
            [[ 'active'], 'integer'],
            ['email', 'email'],
             ['email', 'unique'],
            [['created', 'update', 'last_login','ban','active','online','user_id'], 'safe'],
            [['name', 'email', 'role'], 'string', 'max' => 255],
            
             \Yii::$app->user->isGuest?['verifyCode', 'captcha']:['verifyCode', 'captcha','skipOnEmpty'=>true],
        ];
    }
    
  
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'profile_id' => Yii::t('app', 'Profile ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'role' => Yii::t('app', 'Role'),
            'active' => Yii::t('app', 'Active'),
            'ban' => Yii::t('app', 'Ban'),
            'created' => Yii::t('app', 'Created'),
            'update' => Yii::t('app', 'Update'),
            'last_login' => Yii::t('app', 'Last Login'),
            'online' => Yii::t('app', 'Online'),
           'verifyCode' => 'Verification Code',
        ];
    }
}
