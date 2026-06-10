<?php

use yii\db\Migration;

class m260519_030000_create_customers_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%customers}}', [
            'customer_id' => $this->primaryKey(),
            'customer_name' => $this->string(100)->notNull(),
            'phone' => $this->string(20),
            'email' => $this->string(100),
            'address' => $this->text(),
            'city' => $this->string(50),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-customers-customer_name', '{{%customers}}', 'customer_name');
    }

    public function down()
    {
        $this->dropTable('{{%customers}}');
    }
}
