<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item}}`.
 */
class m210106_035231_create_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(11)->notNull(),
            'price' => $this->integer(11)->notNull(),
            'category_id' => $this->integer(11)->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),

        ]);
        $this->addForeignKey('fk-category_id', 'item', 'category_id', 'item_category', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item}}');
    }
}
