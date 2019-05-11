<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transaction;

/**
 * TransactionSearch represents the model behind the search form of `app\models\Transaction`.
 */
class TransactionSearch extends Transaction
{
    public $date_from;
    public $date_from_visible;
    public $date_to;
    public $date_to_visible;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'date_from', 'date_to', 'implementer'], 'integer'],
            [['type', 'date_from_visible', 'date_to_visible'], 'safe'],
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
        $query = Transaction::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [ 'pageSize' => 100 ],
        ]);

        $dataProvider->sort->defaultOrder['date'] = SORT_DESC;

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'client_id' => $this->client_id,
            'implementer' => $this->implementer,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['>=', 'date', $this->date_from])
            ->andFilterWhere(['<=', 'date', $this->date_to]);

        return $dataProvider;
    }
}
