<?php

use yii\db\Migration;

class m260519_090000_create_customer_credits_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%customer_credits}}', [
            'credit_id' => $this->primaryKey(),
            'customer_id' => $this->integer()->notNull(),
            'total_credit' => $this->decimal(10, 2)->notNull()->defaultValue(0),
            'amount_paid' => $this->decimal(10, 2)->notNull()->defaultValue(0),
            'balance' => $this->decimal(10, 2)->notNull()->defaultValue(0),
            'last_transaction_date' => $this->dateTime(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-customer_credits-customer_id', '{{%customer_credits}}', 'customer_id');
        
        $this->addForeignKey(
            'fk-customer_credits-customer_id',
            '{{%customer_credits}}',
            'customer_id',
            '{{%customers}}',
            'customer_id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk-customer_credits-customer_id', '{{%customer_credits}}');
        $this->dropTable('{{%customer_credits}}');
    }
}
