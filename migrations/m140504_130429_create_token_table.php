<?php

/**
 *
 * @name : eg-user
 * @Version 1.0.0
 * @Author : Jalal Jaberi
 *
 * based on Dektrium user <http://github.com/dektrium>
 */

use elephantsGroup\user\migrations\Migration;

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class m140504_130429_create_token_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%token}}', [
            'user_id'    => $this->integer()->notNull(),
            'code'       => $this->string(32)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'type'       => $this->smallInteger()->notNull(),
        ], $this->tableOptions);

        $this->createIndex('{{%token_unique}}', '{{%token}}', ['user_id', 'code', 'type'], true);
        $this->addForeignKey('{{%fk_user_token}}', '{{%token}}', 'user_id', '{{%user}}', 'id', $this->cascade, $this->restrict);
    }

    public function down()
    {
        $this->dropTable('{{%token}}');
    }
}
