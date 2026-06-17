<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property int $customer_id
 * @property string $customer_name
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property string $city
 * @property int $created_at
 * @property int $updated_at
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%customers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_name'], 'required'],
            [['address'], 'string'],
            [['customer_name', 'city'], 'string', 'max' => 100],
            [['phone', 'email'], 'string', 'max' => 100],
            [['email'], 'email'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'customer_id' => 'Customer ID',
            'customer_name' => 'Customer Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'address' => 'Address',
            'city' => 'City',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets related sales for this customer
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasMany(Sale::class, ['customer_id' => 'customer_id']);
    }
}
