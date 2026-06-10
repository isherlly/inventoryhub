<?php

namespace common\models;

use Yii;

class Supplier extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%suppliers}}';
    }

    public function rules()
    {
        return [
            [['supplier_name'], 'required'],
            [['supplier_name', 'contact_person', 'city'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
            [['email'], 'email'],
            [['address', 'payment_terms'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'supplier_id' => 'Supplier ID',
            'supplier_name' => 'Supplier Name',
            'contact_person' => 'Contact Person',
            'phone' => 'Phone',
            'email' => 'Email',
            'address' => 'Address',
            'city' => 'City',
            'payment_terms' => 'Payment Terms',
        ];
    }

    public function getPurchases()
    {
        return $this->hasMany(Purchase::class, ['supplier_id' => 'supplier_id']);
    }
}
