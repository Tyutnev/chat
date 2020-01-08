<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%message}}`.
 */
class m200105_110010_create_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%message}}', [
            'id' => $this->primaryKey(),
            'id_sender' => $this->integer()->notNull(),
            'id_recipient' => $this->integer()->notNull(),
            'content' => $this->text()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'is_last' => $this->integer()->notNull()->defaultValue(1),
            'status' => $this->integer(1)->defaultValue(1)
        ]);

        $this->addForeignKey(
            'fk-message-id_sender',
            'message',
            'id_sender',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-message-id_recipient',
            'message',
            'id_recipient',
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
        $this->dropTable('{{%message}}');
    }
}
