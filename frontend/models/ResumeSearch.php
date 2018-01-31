<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Resume;

/**
 * ResumeSearch represents the model behind the search form about `common\models\Resume`.
 */
class ResumeSearch extends Resume
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'age'], 'integer'],
            [['category', 'post', 'skills', 'education', 'institution', 'sex', 'city', 'details', 'status', 'publish', 'update'], 'safe'],
            [['salary', 'experience'], 'number'],
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
        $query = Resume::find()->with('categorys');

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
            'salary' => $this->salary,
            'publish' => $this->publish,
            'update' => $this->update,
        ]);

        $query->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'post', $this->post])
            ->andFilterWhere(['<=', 'age', $this->age])
            ->andFilterWhere(['<=', 'experience', $this->experience])
            ->andFilterWhere(['like', 'skills', $this->skills])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'institution', $this->institution])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
