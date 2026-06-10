<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock_alerts".
 *
 * @property int $alert_id
 * @property int $product_id
 * @property int $current_stock
 * @property int $min_stock_level
 * @property boolean $is_active
 * @property string $alert_date
 * @property string $resolved_date
 * @property int $created_at
 */
class StockAlert extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%stock_alerts}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'current_stock', 'min_stock_level', 'alert_date'], 'required'],
            [['product_id', 'current_stock', 'min_stock_level'], 'integer'],
            [['is_active'], 'boolean'],
            [['alert_date', 'resolved_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'alert_id' => 'Alert ID',
            'product_id' => 'Product ID',
            'current_stock' => 'Current Stock',
            'min_stock_level' => 'Minimum Stock Level',
            'is_active' => 'Is Active',
            'alert_date' => 'Alert Date',
            'resolved_date' => 'Resolved Date',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Get related product
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['product_id' => 'product_id']);
    }
}
