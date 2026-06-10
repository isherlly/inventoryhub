<?php

use yii\db\Migration;

class m260519_060000_create_purchases_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%purchases}}', [
            'purchase_id' => $this->primaryKey(),
            'supplier_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'quantity_purchased' => $this->integer()->notNull(),
            'unit_price' => $this->decimal(10, 2)->notNull(),
            'total_cost' => $this->decimal(10, 2)->notNull(),
            'purchase_date' => $this->dateTime()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-purchases-supplier_id', '{{%purchases}}', 'supplier_id');
        $this->createIndex('idx-purchases-product_id', '{{%purchases}}', 'product_id');
        $this->createIndex('idx-purchases-purchase_date', '{{%purchases}}', 'purchase_date');
        
        $this->addForeignKey(
            'fk-purchases-supplier_id',
            '{{%purchases}}',
            'supplier_id',
            '{{%suppliers}}',
            'supplier_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-purchases-product_id',
            '{{%purchases}}',
            'product_id',
            '{{%products}}',
            'product_id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk-purchases-supplier_id', '{{%purchases}}');
        $this->dropForeignKey('fk-purchases-product_id', '{{%purchases}}');
        $this->dropTable('{{%purchases}}');
    }
}
