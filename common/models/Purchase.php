<?php

namespace common\models;

use Yii;

class Purchase extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%purchases}}';
    }

    public function rules()
    {
        return [
            [['supplier_id', 'product_id', 'quantity_purchased', 'unit_price', 'purchase_date'], 'required'],
            [['supplier_id', 'product_id', 'quantity_purchased'], 'integer'],
            [['unit_price', 'total_cost'], 'number'],
            [['purchase_date'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'purchase_id' => 'Purchase ID',
            'supplier_id' => 'Supplier',
            'product_id' => 'Product',
            'quantity_purchased' => 'Quantity',
            'unit_price' => 'Unit Price',
            'total_cost' => 'Total Cost',
            'purchase_date' => 'Purchase Date',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->total_cost = $this->unit_price * $this->quantity_purchased;
            
            // Update product stock
            $product = Product::findOne($this->product_id);
            if ($product) {
                $product->stock_quantity += $this->quantity_purchased;
                $product->save();
            }
            
            return true;
        }
        return false;
    }

    public function getSupplier()
    {
        return $this->hasOne(Supplier::class, ['supplier_id' => 'supplier_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::class, ['product_id' => 'product_id']);
    }
}
