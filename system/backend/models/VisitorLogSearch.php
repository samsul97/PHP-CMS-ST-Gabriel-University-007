<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\VisitorLog;

/**
 * VisitorLogSearch represents the model behind the search form of `backend\models\VisitorLog`.
 */
class VisitorLogSearch extends VisitorLog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['unique_visitor_identifier', 'os', 'browser', 'ip_address', 'geo_location', 'cookies', 'visit_time', 'language', 'referrer', 'visit_url', 'timestamp'], 'safe'],
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
        $query = VisitorLog::find();

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
            'visit_time' => $this->visit_time,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'unique_visitor_identifier', $this->unique_visitor_identifier])
            ->andFilterWhere(['like', 'os', $this->os])
            ->andFilterWhere(['like', 'browser', $this->browser])
            ->andFilterWhere(['like', 'ip_address', $this->ip_address])
            ->andFilterWhere(['like', 'geo_location', $this->geo_location])
            ->andFilterWhere(['like', 'cookies', $this->cookies])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'referrer', $this->referrer])
            ->andFilterWhere(['like', 'visit_url', $this->visit_url]);

        return $dataProvider;
    }
}
