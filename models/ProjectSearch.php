<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Project;

/**
 * ProjectSearch represents the model behind the search form of `app\models\Project`.
 */
class ProjectSearch extends Project
{
    public $sort;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tag', 'date_start', 'client', 'date_update', 'status'], 'integer'],
            [['name'], 'safe'],
            [['price', 'debet', 'credit'], 'number'],
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
        $query = Project::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [ 'pageSize' => 50 ],
        ]);

        $dataProvider->sort->defaultOrder['date_update'] = SORT_DESC;
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tag' => $this->tag,
            'price' => $this->price,
            'date_start' => $this->date_start,
            'client' => $this->client,
            'debet' => $this->debet,
            'credit' => $this->credit,
            'date_update' => $this->date_update,
            'status' => isset($this->status)?$this->status:1,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
