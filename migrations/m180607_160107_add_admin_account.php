<?php

/**
 *
 * @name : eg-user
 * @Version 1.0.0
 * @Author : Jalal Jaberi
 *
 * based on Dektrium user <http://github.com/dektrium>
 */

use yii\db\Migration;

class m180607_160107_add_admin_account extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->insert('{{%user}}', [
            'id'                   => 1,
            'username'             => 'admin',
            'email'                => 'admin@example.com',
            'password_hash'        => \Yii::$app->security->generatePasswordHash('12345678'),
            'auth_key'             => \Yii::$app->security->generateRandomString(),
			'registration_ip'      => '127.0.01',
            'confirmed_at'         => time(),
            'created_at'           => time(),
            'updated_at'           => time(),
			'flags'                => 100
		]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		$this->delete('{{%user}}', ['id' => 1]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180607_160107_add_admin_account cannot be reverted.\n";

        return false;
    }
    */
}
