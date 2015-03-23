<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "in_tags".
 *
 * @property integer $rate_id
 * @property string $name
 * @property integer $fr
 */
class Tags extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'in_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'fr'], 'required'],
            [['fr'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

  

    public function findFrfrequency($limit = 20) {

        $model = $this->find()->limit($limit)->orderBy(['fr' => SORT_DESC])->all();

        $total = 0;
        foreach ($model as $tag) {
            $total += $tag->fr;
        }

        $tags = array();
        if ($total > 0) {

            foreach ($model as $tag){
                $tags[$tag->name] = 10 + (int) (16 * $tag->fr / ($total + 10));
            ksort($tags);
        }
        
        return $tags;
        }
    }
    
      public static function arrayString($tags) {

        return implode(",", $tags);
    }

    
    public static function stringArray($tags) {
       
        return explode(",", $tags);
    }
    
    public function updateFrequency($oldTags, $newTags)
    {
         
		$oldTags=self::stringArray($oldTags);
		$newTags=self::stringArray($newTags);
		$this->addTags(array_values(array_diff($newTags,$oldTags)));
		$this->deleteTags(array_values(array_diff($oldTags,$newTags)));
   }

    public function addTags($tags) {
//        $tagar = Tags::stringArray($tags);
        
        foreach ($tags as $tag){
           if($this->findAll(['name'=>$tag])){
            $this->updateAllCounters(['fr'=>1],'name=:name',[':name'=>$tag]);
           }
           else{
               
               $tagmodel = new Tags();
               $tagmodel->name = $tag;
               $tagmodel->fr=1;
               $tagmodel->save();
           }
         
        }
    }

    public function deleteTags($tags) {
//        $tagar = Tags::stringArray($tags);
        foreach ($tags as $tag){
         if($this->findAll(['name'=>$tag])){
            $this->updateAllCounters(['fr'=>-1],'name=:name',[':name'=>$tag]);
            $this->deleteAll('fr<=0');
           }
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'rate_id' => Yii::t('app', 'Rate ID'),
            'name' => Yii::t('app', 'Name'),
            'fr' => Yii::t('app', 'Fr'),
        ];
    }

}
