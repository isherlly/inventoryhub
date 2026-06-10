<?php

use yii\db\Migration;

class m260519_040000_create_stock_alerts_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%stock_alerts}}', [
            'alert_id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'current_stock' => $this->integer()->notNull(),
            'min_stock_level' => $this->integer()->notNull(),
            'is_active' => $this->boolean()->defaultValue(1),
            'alert_date' => $this->dateTime()->notNull(),
            'resolved_date' => $this->dateTime(),
            'created_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-stock_alerts-product_id', '{{%stock_alerts}}', 'product_id');
        $this->createIndex('idx-stock_alerts-is_active', '{{%stock_alerts}}', 'is_active');
        
        // Add foreign key
        $this->addForeignKey(
            'fk-stock_alerts-product_id',
            '{{%stock_alerts}}',
            'product_id',
            '{{%products}}',
            'product_id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk-stock_alerts-product_id', '{{%stock_alerts}}');
        $this->dropTable('{{%stock_alerts}}');
    }
}
