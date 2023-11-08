<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Slider;

/**
 * SliderSearch represents the model behind the search form of `backend\models\Slider`.
 */
class SliderSearch extends Slider
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['banner', 'small_title', 'big_title', 'content', 'timestamp'], 'safe'],
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
        $query = Slider::find();

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
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'banner', $this->banner])
            ->andFilterWhere(['like', 'small_title', $this->small_title])
            ->andFilterWhere(['like', 'big_title', $this->big_title])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
