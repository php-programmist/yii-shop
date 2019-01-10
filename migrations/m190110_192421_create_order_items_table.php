<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_items`.
 * Has foreign keys to the tables:
 *
 * - `order`
 * - `product`
 */
class m190110_192421_create_order_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order_items', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->unsigned(),
            'product_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'price' => $this->float(2)->notNull(),
            'qty_item' => $this->integer()->notNull(),
            'sum_item' => $this->float(2)->notNull(),
        ]);

        // creates index for column `order_id`
        $this->createIndex(
            'idx-order_items-order_id',
            'order_items',
            'order_id'
        );

        // add foreign key for table `order`
        $this->addForeignKey(
            'fk-order_items-order_id',
            'order_items',
            'order_id',
            'order',
            'id',
            'CASCADE'
        );

        // creates index for column `product_id`
        $this->createIndex(
            'idx-order_items-product_id',
            'order_items',
            'product_id'
        );

        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-order_items-product_id',
            'order_items',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `order`
        $this->dropForeignKey(
            'fk-order_items-order_id',
            'order_items'
        );

        // drops index for column `order_id`
        $this->dropIndex(
            'idx-order_items-order_id',
            'order_items'
        );

        // drops foreign key for table `product`
        $this->dropForeignKey(
            'fk-order_items-product_id',
            'order_items'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            'idx-order_items-product_id',
            'order_items'
        );

        $this->dropTable('order_items');
    }
}
