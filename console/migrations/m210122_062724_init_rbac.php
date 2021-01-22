<?php

use yii\db\Migration;

/**
 * Class m210122_062724_init_rbac
 */
class m210122_062724_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // add "admin" role and give this role backend permission
        $admin = $auth->createRole('admin');
        $auth->add($admin);

        // add "user" role and give this role the none permission
        $user = $auth->createRole('user');
        $auth->add($user);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        $auth->assign($admin, 2); // untuk user ber id 2
        $auth->assign($user, 1);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210122_062724_init_rbac cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210122_062724_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
