<?php

use yii\db\Migration;
use yii\db\Query;

/**
 * Class m190201_211434_add_columns_to_profile_table
 */
class m190201_211434_add_columns_to_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $db = \Yii::$app->db;
      $query = new Query();
      if ($db->schema->getTableSchema("{{%profile}}", true) !== null)
      {
        $this->dropColumn('{{%profile}}', 'name');
        $this->dropColumn('{{%profile}}', 'gravatar_email');
        $this->dropColumn('{{%profile}}', 'gravatar_id');
        $this->addColumn('{{%profile}}', 'first_name', $this->string(255)->after('user_id'));
        $this->addColumn('{{%profile}}', 'last_name', $this->string(255)->after('first_name'));
        $this->addColumn('{{%profile}}', 'mobile', $this->string(255)->after('last_name'));
        $this->addColumn('{{%profile}}', 'thumb', $this->string(15)->notNull()->defaultValue('default.png')->after('mobile'));
        $this->addColumn('{{%profile}}', 'creation_time', $this->timestamp()->after('timezone'));
        $this->addColumn('{{%profile}}', 'update_time', $this->timestamp()->after('creation_time'));
      }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
      $this->dropColumn('{{%profile}}', 'first_name');
      $this->dropColumn('{{%profile}}', 'last_name');
      $this->dropColumn('{{%profile}}', 'mobile');
      $this->dropColumn('{{%profile}}', 'thumb');
      $this->dropColumn('{{%profile}}', 'creation_time');
      $this->dropColumn('{{%profile}}', 'update_time');
      $this->addColumn('{{%profile}}', 'name', $this->string(255)->after('user_id'));
      $this->addColumn('{{%profile}}', 'gravatar_email', $this->string(255)->after('name'));
      $this->addColumn('{{%profile}}', 'gravatar_id', $this->string(32)->after('gravatar_email'));
    }
}
