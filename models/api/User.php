<?php

namespace app\models\api;

use Yii;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "in_users".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_users';
    }
    
    public function fields()
{
    $fields = parent::fields();

    // remove fields that contain sensitive information
    unset($fields['password'], $fields['authKey']);

    return $fields;
}
    
   

    public function getProfile()
    {
        
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }
    
      public static function findIdentity($id)
    {
        return static::findOne($id);
    }
     public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }
    
    public static function findByUsername($username){
        return static::findOne(['username'=>$username]);
    }

    public function getId()
    {
        return $this->id;
    }
    

    
    public function getAuthKey()
    {
        return $this->authKey
;
    }
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    
    public function beforeSave($insert)
{
        if($this->isNewRecord){
            $this->authKey=Yii::$app->getSecurity()->generateRandomString();;
        }
        $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
       
        $this->accessToken='xxxx';
      
       
  
    return parent::beforeSave($insert);
}

        

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//             ['username', 'exist'],
            [['username', 'password', ], 'required'],
             [['username', 'password'], 'string', 'max' => 255],
            
            [['authKey', 'accessToken'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Login'),
            'password' => Yii::t('app', 'Password'),
            'authKey' => Yii::t('app', 'Auth Key'),
            'accessToken' => Yii::t('app', 'Access Token'),
        ];
    }
}
