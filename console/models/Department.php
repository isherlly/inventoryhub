<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property string $department_id
 * @property string $department_name
 */
class Department extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['department_id', 'department_name'], 'required'],
            [['department_id'], 'string', 'max' => 10],
            [['department_name'], 'string', 'max' => 35],
            [['department_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'department_id' => 'Department ID',
            'department_name' => 'Department Name',
        ];
    }

}
