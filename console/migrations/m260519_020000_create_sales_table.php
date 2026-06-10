<?php

use yii\db\Migration;

class m260519_020000_create_sales_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%sales}}', [
            'sale_id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'customer_name' => $this->string(100),
            'quantity_sold' => $this->integer()->notNull(),
            'cost_price' => $this->decimal(10, 2)->notNull(),
            'selling_price' => $this->decimal(10, 2)->notNull(),
            'total_sale_price' => $this->decimal(10, 2)->notNull(),
            'profit' => $this->decimal(10, 2)->notNull(),
            'sale_date' => $this->dateTime()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-sales-product_id', '{{%sales}}', 'product_id');
        $this->createIndex('idx-sales-sale_date', '{{%sales}}', 'sale_date');
        
        // Add foreign key
        $this->addForeignKey(
            'fk-sales-product_id',
            '{{%sales}}',
            'product_id',
            '{{%products}}',
            'product_id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk-sales-product_id', '{{%sales}}');
        $this->dropTable('{{%sales}}');
    }
}
