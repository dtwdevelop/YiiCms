<?php

namespace app\modules\media\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\media\models\Medias;

/**
 * SearchMedias represents the model behind the search form about `app\modules\media\models\Medias`.
 */
class SearchMedias extends Medias
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['media_id', 'user_id', 'show', 'view'], 'integer'],
            [['title', 'picture', 'topic', 'url', 'meta', 'meta_tags', 'created'], 'safe'],
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
        $query = Medias::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'media_id' => $this->media_id,
            'user_id' => $this->user_id,
            'show' => $this->show,
            'created' => $this->created,
            'view' => $this->view,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'picture', $this->picture])
            ->andFilterWhere(['like', 'topic', $this->topic])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'meta', $this->meta])
            ->andFilterWhere(['like', 'meta_tags', $this->meta_tags]);

        return $dataProvider;
    }
}
