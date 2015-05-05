<?php

namespace app\modules\article\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\article\models\Tags;

/**
 * SearchTags represents the model behind the search form about `app\modules\article\models\Tags`.
 */
class SearchTags extends Tags
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rate_id', 'fr'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Tags::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'rate_id' => $this->rate_id,
            'fr' => $this->fr,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
