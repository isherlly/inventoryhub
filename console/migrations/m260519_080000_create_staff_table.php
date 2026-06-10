<?php

use yii\db\Migration;

class m260519_080000_create_staff_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%staff}}', [
            'staff_id' => $this->primaryKey(),
            'staff_name' => $this->string(100)->notNull(),
            'position' => $this->string(50)->notNull(),
            'phone' => $this->string(20),
            'email' => $this->string(100),
            'salary' => $this->decimal(10, 2),
            'hire_date' => $this->date(),
            'status' => $this->string(20)->defaultValue('active'),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-staff-position', '{{%staff}}', 'position');
        $this->createIndex('idx-staff-status', '{{%staff}}', 'status');
    }

    public function down()
    {
        $this->dropTable('{{%staff}}');
    }
}
