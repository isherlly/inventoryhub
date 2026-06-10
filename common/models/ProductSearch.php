<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProductSearch represents the model behind the search form of `common\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'stock_quantity', 'min_stock_level'], 'integer'],
            [['product_name', 'category', 'description'], 'safe'],
            [['cost_price', 'selling_price'], 'number'],
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
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 20],
            'sort' => [
                'defaultOrder' => ['product_id' => SORT_DESC]
            ]
        ]);

        $this->load($params, '');
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'description', $this->description]);

        if ($this->cost_price !== null) {
            $query->andFilterWhere(['>=', 'cost_price', $this->cost_price]);
        }

        if ($this->selling_price !== null) {
            $query->andFilterWhere(['<=', 'selling_price', $this->selling_price]);
        }

        $query->andFilterWhere([
            'stock_quantity' => $this->stock_quantity,
            'min_stock_level' => $this->min_stock_level,
        ]);

        return $dataProvider;
    }
}
