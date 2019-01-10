<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m190110_190919_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey()->unsigned(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'qty' => $this->integer()->defaultValue(0),
            'sum' => $this->float(2)->defaultValue(0),
            'status' => $this->integer()->defaultValue(0),
            'name' => $this->string(),
            'email' => $this->string(),
            'phone' => $this->string(),
            'address' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('order');
    }
}
