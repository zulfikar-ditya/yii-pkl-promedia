<?php

use yii\db\Migration;

/**
 * Class m210114_052018_alter_order
 */
class m210114_052018_alter_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('order', 'customer_id', $this->integer()->notNull()); // satu custommer hanya memiliki satu order
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210114_052018_alter_order cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210114_052018_alter_order cannot be reverted.\n";

        return false;
    }
    */
}
