<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%statistic}}`.
 */
class m210107_045608_create_statistic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%statistic}}', [
            'id' => $this->primaryKey(),
            'datetime' => $this->dateTime(),
            'user_ip' => $this->string(20),
            'user_host' => $this->string(50),
            'path_info' => $this->string(50),
            'query_string' => $this->string(50),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%statistic}}');
    }
}
