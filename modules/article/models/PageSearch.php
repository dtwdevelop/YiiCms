<?php

namespace app\modules\article\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\article\models\Page;

/**
 * PageSearch represents the model behind the search form about `app\models\Page`.
 */
class PageSearch extends Page
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id', 'category_id', 'show', 'view'], 'integer'],
            [['title', 'topic', 'url', 'meta', 'meta_tags', 'created', 'update'], 'safe'],
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
        $query = Page::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'page_id' => $this->page_id,
            'category_id' => $this->category_id,
            'show' => $this->show,
            'created' => $this->created,
            'update' => $this->update,
            'view' => $this->view,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'topic', $this->topic])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'meta', $this->meta])
            ->andFilterWhere(['like', 'meta_tags', $this->meta_tags]);

        return $dataProvider;
    }
}
