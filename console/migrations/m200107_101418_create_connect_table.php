<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%connect}}`.
 */
class m200107_101418_create_connect_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%connect}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'is_online' => $this->integer(1)->defaultValue(0),
            'exit_date' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk-connect-id_user',
            'connect',
            'id_user',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%connect}}');
    }
}
