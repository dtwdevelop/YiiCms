<?php

namespace app\modules\article\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\article\models\Categories;

/**
 * CategoriesSearch represents the model behind the search form about `app\models\Categories`.
 */
class CategoriesSearch extends Categories
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'parent_id', 'show', 'view'], 'integer'],
            [['title', 'about', 'url', 'meta', 'meta_tags', 'pos', 'created'], 'safe'],
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
        $query = Categories::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'category_id' => $this->category_id,
            'parent_id' => $this->parent_id,
            'show' => $this->show,
            'created' => $this->created,
            'view' => $this->view,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'about', $this->about])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'meta', $this->meta])
            ->andFilterWhere(['like', 'meta_tags', $this->meta_tags])
            ->andFilterWhere(['like', 'pos', $this->pos]);

        return $dataProvider;
    }
}
