<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 * Has foreign keys to the tables:
 *
 * - `category`
 */
class m190109_121900_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'name' => $this->string(),
            'content' => $this->text(),
            'price' => $this->float()->defaultValue(0),
            'keywords' => $this->string(),
            'description' => $this->string(),
            'img' => $this->string()->defaultValue('no-image.png'),
            'hit' => $this->integer()->defaultValue(0),
            'new' => $this->integer()->defaultValue(0),
            'sale' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `category_id`
        $this->createIndex(
            'idx-product-category_id',
            'product',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-product-category_id',
            'product',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-product-category_id',
            'product'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-product-category_id',
            'product'
        );

        $this->dropTable('product');
    }
}
