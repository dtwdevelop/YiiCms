<?php

namespace app\modules\media\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\media\models\Files;

/**
 * SearchFile represents the model behind the search form about `app\modules\media\models\Files`.
 */
class SearchFile extends Files
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_id', 'media_id', 'show', 'like', 'view'], 'integer'],
            [['title', 'big_foto', 'big_small', 'topic', 'url', 'meta', 'meta_tags', 'created'], 'safe'],
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
        $query = Files::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'file_id' => $this->file_id,
            'media_id' => $this->media_id,
            'show' => $this->show,
            'created' => $this->created,
            'like' => $this->like,
            'view' => $this->view,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'big_foto', $this->big_foto])
            ->andFilterWhere(['like', 'big_small', $this->big_small])
            ->andFilterWhere(['like', 'topic', $this->topic])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'meta', $this->meta])
            ->andFilterWhere(['like', 'meta_tags', $this->meta_tags]);

        return $dataProvider;
    }
}
