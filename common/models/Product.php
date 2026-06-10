<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $product_id
 * @property string $product_name
 * @property string $category
 * @property float $cost_price
 * @property float $selling_price
 * @property int $stock_quantity
 * @property int $min_stock_level
 * @property string $description
 * @property int $created_at
 * @property int $updated_at
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_name', 'category', 'cost_price', 'selling_price'], 'required'],
            [['stock_quantity', 'min_stock_level'], 'integer'],
            [['cost_price', 'selling_price'], 'number'],
            [['description'], 'string'],
            [['product_name'], 'string', 'max' => 100],
            [['category'], 'string', 'max' => 50],
            [['selling_price'], 'compare', 'compareAttribute' => 'cost_price', 'operator' => '>'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'product_name' => 'Product Name',
            'category' => 'Category',
            'cost_price' => 'Cost Price',
            'selling_price' => 'Selling Price',
            'stock_quantity' => 'Stock Quantity',
            'min_stock_level' => 'Minimum Stock Level',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Get profit margin percentage
     */
    public function getProfitMargin()
    {
        if ($this->cost_price == 0) return 0;
        return (($this->selling_price - $this->cost_price) / $this->cost_price) * 100;
    }

    /**
     * Get potential profit from current stock
     */
    public function getPotentialProfit()
    {
        return ($this->selling_price - $this->cost_price) * $this->stock_quantity;
    }

    /**
     * Check if stock is low
     */
    public function isLowStock()
    {
        return $this->stock_quantity <= $this->min_stock_level;
    }

    /**
     * Get related sales
     */
    public function getSales()
    {
        return $this->hasMany(Sale::class, ['product_id' => 'product_id']);
    }
}
