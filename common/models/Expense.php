<?php

namespace common\models;

use Yii;

class Expense extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%expenses}}';
    }

    public function rules()
    {
        return [
            [['expense_type', 'amount', 'expense_date'], 'required'],
            [['expense_type'], 'string', 'max' => 50],
            [['description'], 'string'],
            [['amount'], 'number'],
            [['expense_date'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'expense_id' => 'Expense ID',
            'expense_type' => 'Expense Type',
            'description' => 'Description',
            'amount' => 'Amount',
            'expense_date' => 'Date',
        ];
    }

    /**
     * Gets the staff member responsible for this expense (if applicable)
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(Staff::class, ['staff_id' => 'staff_id']);
    }
}
