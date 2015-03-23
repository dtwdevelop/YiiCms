<?php

namespace app\modules\media\models;

use Yii;

/**
 * This is the model class for table "in_rating".
 *
 * @property integer $rate_id
 * @property integer $user_id
 * @property integer $foto_id
 * @property integer $rating
 * @property string $ip
 * @property string $created
 */
use yii\db\Expression;
class Rating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function beforeValidate() {
        if($this->isNewRecord){
            $this->created =new Expression('NOW()');
    }
        return parent::beforeValidate();
    }
    public static function tableName()
    {
        return 'in_rating';
    }
    public function TotalVoteRating($id){
        $sql = "SELECT SUM(rating) as sum FROM in_rating where foto_id=$id";
        return $this->findBySql($sql)->asArray()->all();
    }
    public function totalVote($id){
       $sql = "SELECT COUNT(*) as total FROM in_rating where foto_id=$id";
        return $this->findBySql($sql)->asArray()->all();
    }
    public function Vote($id){
        $totalrate  = $this->TotalVoteRating($id);
        $totalvote =  $this->totalVote($id);
        if(!empty($totalrate[0]['sum']) && !empty($totalvote[0]['total'])){
            $rezult  = $totalrate[0]['sum'] / $totalvote[0]['total'];
            return $rezult;
        }
        else{
            return $rezult=0;
        }
        
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'foto_id', 'rating', 'ip', 'created'], 'required'],
            [['user_id', 'foto_id','rating'], 'integer'],
            [['created'], 'safe'],
            [[ 'ip'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rate_id' => Yii::t('app', 'Rate ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'foto_id' => Yii::t('app', 'Foto ID'),
            'rating' => Yii::t('app', 'Rating'),
            'ip' => Yii::t('app', 'Ip'),
            'created' => Yii::t('app', 'Created'),
        ];
    }
}
