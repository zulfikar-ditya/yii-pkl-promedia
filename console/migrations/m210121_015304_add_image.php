<?php

use yii\db\Migration;

/**
 * Class m210121_015304_add_image
 */
class m210121_015304_add_image extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('item', 'image', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210121_015304_add_image cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210121_015304_add_image cannot be reverted.\n";

        return false;
    }
    */
}
