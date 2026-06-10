<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stock".
 *
 * @property int $stock_id
 * @property string $stock_name
 * @property string $stock_category
 * @property int $amount
 */
class Stock extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stock_name', 'stock_category', 'amount'], 'required'],
            [['amount'], 'integer'],
            [['stock_name'], 'string', 'max' => 50],
            [['stock_category'], 'string', 'max' => 35],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'stock_id' => 'Stock ID',
            'stock_name' => 'Stock Name',
            'stock_category' => 'Stock Category',
            'amount' => 'Amount',
        ];
    }

}
