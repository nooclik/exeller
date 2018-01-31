<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Request;

/**
 * RequestSearch represents the model behind the search form about `common\models\Request`.
 */
class RequestSearch extends Request
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'payment_id'], 'integer'],
            [['category', 'short_description', 'description', 'date_to_date_before', 'date_to_date_after', 'date_to_time_before', 'date_to_time_after', 'city', 'customer_info', 'address', 'attachment', 'status', 'publish', 'update'], 'safe'],
            [['price'], 'number'],
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
        $query = Request::find();

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
            'date_to_date_before' => $this->date_to_date_before,
            'date_to_date_after' => $this->date_to_date_after,
            'date_to_time_before' => $this->date_to_time_before,
            'date_to_time_after' => $this->date_to_time_after,
            'payment_id' => $this->payment_id,
            'publish' => $this->publish,
            'update' => $this->update,
        ]);

        $query->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['>=', 'price', $this->price])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'customer_info', $this->customer_info])
            ->andFilterWhere(['like', 'address', $this->address])
            //->andFilterWhere(['like', 'nicename', $this->user->nicename])
            ->andFilterWhere(['like', 'attachment', $this->attachment])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
