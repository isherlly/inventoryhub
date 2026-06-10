<?php

use yii\db\Migration;

class m260518_create_orders_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%orders}}', [
            'order_id' => $this->primaryKey(),
            'stock_id' => $this->integer()->notNull(),
            'user_name' => $this->string(30)->notNull(),
            'department' => $this->string(20)->notNull(),
            'amount' => $this->integer()->notNull(),
            'place' => $this->string(50)->notNull(),
        ], $tableOptions);

        // Create index on stock_id for better query performance
        $this->createIndex('idx-orders-stock_id', '{{%orders}}', 'stock_id');
    }

    public function down()
    {
        $this->dropTable('{{%orders}}');
    }
}
