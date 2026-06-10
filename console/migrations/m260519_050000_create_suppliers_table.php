<?php

use yii\db\Migration;

class m260519_050000_create_suppliers_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%suppliers}}', [
            'supplier_id' => $this->primaryKey(),
            'supplier_name' => $this->string(100)->notNull(),
            'contact_person' => $this->string(100),
            'phone' => $this->string(20),
            'email' => $this->string(100),
            'address' => $this->text(),
            'city' => $this->string(50),
            'payment_terms' => $this->string(50),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-suppliers-supplier_name', '{{%suppliers}}', 'supplier_name');
    }

    public function down()
    {
        $this->dropTable('{{%suppliers}}');
    }
}
