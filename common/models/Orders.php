<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $order_id
 * @property int $stock_id
 * @property string $user_name
 * @property string $department
 * @property int $amount
 * @property string $place
 */
class Orders extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stock_id', 'user_name', 'department', 'amount', 'place'], 'required'],
            [['stock_id', 'amount'], 'integer'],
            [['user_name'], 'string', 'max' => 30],
            [['department'], 'string', 'max' => 20],
            [['place'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'stock_id' => 'Stock ID',
            'user_name' => 'User Name',
            'department' => 'Department',
            'amount' => 'Amount',
            'place' => 'Place',
        ];
    }

}
