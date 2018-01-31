<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Vacancy;

/**
 * VacancySearch represents the model behind the search form about `common\models\Vacancy`.
 */
class VacancySearch extends Vacancy
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['name', 'category', 'description', 'post', 'city', 'status', 'publish', 'update'], 'safe'],
            [['price', 'experience'], 'number'],
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
        $query = Vacancy::find();

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
            'price' => $this->price,
            'experience' => $this->experience,
            'user_id' => $this->user_id,
            'publish' => $this->publish,
            'update' => $this->update,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'post', $this->post])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
