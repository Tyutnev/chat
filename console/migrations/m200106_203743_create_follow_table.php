<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%follow}}`.
 */
class m200106_203743_create_follow_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%follow}}', [
            'id' => $this->primaryKey(),
            'id_sender' => $this->integer()->notNull(),
            'id_recipient' => $this->integer()->notNull(),
            'status' => $this->integer(1)->notNull()
        ]);

        $this->addForeignKey(
            'fk-follow-id_sender',
            'follow',
            'id_sender',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-follow-id_recipient',
            'follow',
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
        $this->dropTable('{{%follow}}');
    }
}
