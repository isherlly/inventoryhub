<?php

namespace common\models;

use Yii;

class Staff extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%staff}}';
    }

    public function rules()
    {
        return [
            [['staff_name', 'position'], 'required'],
            [['staff_name', 'position', 'city'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
            [['email'], 'email'],
            [['salary'], 'number'],
            [['hire_date', 'status'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'staff_id' => 'Staff ID',
            'staff_name' => 'Name',
            'position' => 'Position',
            'phone' => 'Phone',
            'email' => 'Email',
            'salary' => 'Monthly Salary',
            'hire_date' => 'Hire Date',
            'status' => 'Status',
        ];
    }

    /**
     * Gets related sales for this staff member
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasMany(Sale::class, ['staff_id' => 'staff_id']);
    }
}
