<?php

namespace common\models;

use Yii;

class CustomerCredit extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%customer_credits}}';
    }

    public function rules()
    {
        return [
            [['customer_id'], 'required'],
            [['customer_id'], 'integer'],
            [['total_credit', 'amount_paid', 'balance'], 'number'],
            [['last_transaction_date'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'credit_id' => 'Credit ID',
            'customer_id' => 'Customer',
            'total_credit' => 'Total Credit',
            'amount_paid' => 'Amount Paid',
            'balance' => 'Balance',
            'last_transaction_date' => 'Last Transaction',
        ];
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::class, ['customer_id' => 'customer_id']);
    }
}
