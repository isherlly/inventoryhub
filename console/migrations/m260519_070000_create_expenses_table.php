<?php

use yii\db\Migration;

class m260519_070000_create_expenses_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%expenses}}', [
            'expense_id' => $this->primaryKey(),
            'expense_type' => $this->string(50)->notNull(),
            'description' => $this->text(),
            'amount' => $this->decimal(10, 2)->notNull(),
            'expense_date' => $this->dateTime()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-expenses-expense_type', '{{%expenses}}', 'expense_type');
        $this->createIndex('idx-expenses-expense_date', '{{%expenses}}', 'expense_date');
    }

    public function down()
    {
        $this->dropTable('{{%expenses}}');
    }
}
