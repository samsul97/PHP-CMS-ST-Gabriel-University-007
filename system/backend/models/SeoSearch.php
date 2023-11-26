<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Seo;

/**
 * SeoSearch represents the model behind the search form of `backend\models\Seo`.
 */
class SeoSearch extends Seo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by'], 'integer'],
            [['controller', 'view', 'title', 'keywords', 'description', 'canonical', 'heading_1', 'heading_2', 'heading_3', 'heading_4', 'heading_5', 'heading_6', 'robots', 'schema_properties', 'created_at', 'updated_at', 'timestamp'], 'safe'],
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
    public function search($params)
    {
        $query = Seo::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'controller', $this->controller])
            ->andFilterWhere(['like', 'view', $this->view])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'canonical', $this->canonical])
            ->andFilterWhere(['like', 'heading_1', $this->heading_1])
            ->andFilterWhere(['like', 'heading_2', $this->heading_2])
            ->andFilterWhere(['like', 'heading_3', $this->heading_3])
            ->andFilterWhere(['like', 'heading_4', $this->heading_4])
            ->andFilterWhere(['like', 'heading_5', $this->heading_5])
            ->andFilterWhere(['like', 'heading_6', $this->heading_6])
            ->andFilterWhere(['like', 'robots', $this->robots])
            ->andFilterWhere(['like', 'schema_properties', $this->schema_properties]);

        return $dataProvider;
    }
}
