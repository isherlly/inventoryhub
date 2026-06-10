<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SaleSearch represents the model behind the search form of `common\models\Sale`.
 */
class SaleSearch extends Sale
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sale_id', 'product_id', 'quantity_sold'], 'integer'],
            [['customer_name', 'sale_date'], 'safe'],
            [['cost_price', 'selling_price', 'total_sale_price', 'profit'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
        $query = Sale::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 20],
            'sort' => [
                'defaultOrder' => ['sale_id' => SORT_DESC]
            ]
        ]);

        $this->load($params, '');
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'product_id' => $this->product_id,
            'quantity_sold' => $this->quantity_sold,
        ])
        ->andFilterWhere(['like', 'customer_name', $this->customer_name]);

        if ($this->sale_date) {
            $query->andFilterWhere(['like', 'DATE(sale_date)', $this->sale_date]);
        }

        return $dataProvider;
    }
}
