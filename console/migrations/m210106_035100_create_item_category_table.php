<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item_category}}`.
 */
class m210106_035100_create_item_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item_category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'parent_category' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item_category}}');
    }
}
