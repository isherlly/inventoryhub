<?php

use yii\db\Migration;

class m260519_010000_create_products_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%products}}', [
            'product_id' => $this->primaryKey(),
            'product_name' => $this->string(100)->notNull(),
            'category' => $this->string(50)->notNull(),
            'cost_price' => $this->decimal(10, 2)->notNull(),
            'selling_price' => $this->decimal(10, 2)->notNull(),
            'stock_quantity' => $this->integer()->notNull()->defaultValue(0),
            'min_stock_level' => $this->integer()->notNull()->defaultValue(5),
            'description' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-products-category', '{{%products}}', 'category');
    }

    public function down()
    {
        $this->dropTable('{{%products}}');
    }
}
