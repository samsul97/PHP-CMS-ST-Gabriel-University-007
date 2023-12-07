<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Chat;

/**
 * ChatSearch represents the model behind the search form of `backend\models\Chat`.
 */
class ChatSearch extends Chat
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['reply_type', 'ask', 'answer', 'message', 'ip_address', 'timestamp'], 'safe'],
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
        $query = Chat::find();

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
            'user_id' => $this->user_id,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'reply_type', $this->reply_type])
            ->andFilterWhere(['like', 'ask', $this->ask])
            ->andFilterWhere(['like', 'answer', $this->answer])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'ip_address', $this->ip_address]);

        return $dataProvider;
    }
}
