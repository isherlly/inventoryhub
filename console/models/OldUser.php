<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "olduser".
 *
 * @property int $user_id
 * @property string $full_name
 * @property string $user_name
 * @property string $password
 * @property string $role
 * @property string $department_id
 */
class OldUser extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'olduser';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'user_name', 'password', 'role', 'department_id'], 'required'],
            [['full_name'], 'string', 'max' => 25],
            [['user_name'], 'string', 'max' => 30],
            [['password'], 'string', 'max' => 200],
            [['role'], 'string', 'max' => 20],
            [['department_id'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'full_name' => 'Full Name',
            'user_name' => 'User Name',
            'password' => 'Password',
            'role' => 'Role',
            'department_id' => 'Department ID',
        ];
    }

}
