<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Article;

/**
 * ArticleSearch represents the model behind the search form of `backend\models\Article`.
 */
class ArticleSearch extends Article
{
    public $searchQuery;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'article_category_id', 'created_by', 'updated_by'], 'integer'],
            [['title', 'image', 'content', 'created_at', 'updated_at', 'timestamp', 'globalSearch'], 'safe'],
            ['searchQuery', 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function search()
    {
        $query = Article::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10, // Set the number of results per page
            ],
        ]);

        // $this->load($params);

        // if (!$this->load($params) || !$this->validate()) {
        //     // uncomment the following line if you do not want to return any records when validation fails
        //     // $query->where('0=1');
        //     return $dataProvider;
        // }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'article_category_id' => $this->article_category_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'title', $this->searchQuery])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'content', $this->searchQuery]);

        return $dataProvider;
    }
}
