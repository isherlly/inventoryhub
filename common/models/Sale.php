<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sales".
 *
 * @property int $sale_id
 * @property int $product_id
 * @property string $customer_name
 * @property int $quantity_sold
 * @property float $cost_price
 * @property float $selling_price
 * @property float $total_sale_price
 * @property float $profit
 * @property string $sale_date
 * @property int $created_at
 * @property int $updated_at
 */
class Sale extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%sales}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'quantity_sold', 'cost_price', 'selling_price', 'sale_date'], 'required'],
            [['product_id', 'quantity_sold'], 'integer'],
            [['cost_price', 'selling_price', 'total_sale_price', 'profit'], 'number'],
            [['sale_date'], 'safe'],
            [['customer_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sale_id' => 'Sale ID',
            'product_id' => 'Product ID',
            'customer_name' => 'Customer Name',
            'quantity_sold' => 'Quantity Sold',
            'cost_price' => 'Cost Price',
            'selling_price' => 'Selling Price',
            'total_sale_price' => 'Total Sale Price',
            'profit' => 'Profit',
            'sale_date' => 'Sale Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Before save - calculate profit and total price
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->total_sale_price = $this->selling_price * $this->quantity_sold;
            $this->profit = ($this->selling_price - $this->cost_price) * $this->quantity_sold;
            
            // Update product stock
            $product = Product::findOne($this->product_id);
            if ($product) {
                $product->stock_quantity -= $this->quantity_sold;
                if ($product->stock_quantity < 0) {
                    $product->stock_quantity = 0;
                }
                $product->save();
                
                // Check for low stock and create alert if needed
                if ($product->isLowStock()) {
                    $existingAlert = StockAlert::find()
                        ->where(['product_id' => $this->product_id, 'is_active' => 1])
                        ->one();
                    
                    if (!$existingAlert) {
                        $alert = new StockAlert();
                        $alert->product_id = $this->product_id;
                        $alert->current_stock = $product->stock_quantity;
                        $alert->min_stock_level = $product->min_stock_level;
                        $alert->is_active = 1;
                        $alert->alert_date = date('Y-m-d H:i:s');
                        $alert->save();
                    }
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Get related product
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['product_id' => 'product_id']);
    }
}
