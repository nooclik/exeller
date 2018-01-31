<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * SearchProduct represents the model behind the search form about `common\models\Product`.
 */
class SearchProduct extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'category', 'delivery_id', 'count_view'], 'integer'],
            [['short_description', 'full_description', 'condition', 'status', 'publish', 'update'], 'safe'],
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
        $query = Product::find();

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
            'category' => $this->category,
            'price' => $this->price,
            'delivery_id' => $this->delivery_id,
            'count_view' => $this->count_view,
            'publish' => $this->publish,
            'update' => $this->update,
        ]);

        $query->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'full_description', $this->full_description])
            ->andFilterWhere(['like', 'condition', $this->condition])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
