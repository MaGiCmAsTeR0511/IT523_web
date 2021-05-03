<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%send_updates_to_user}}`.
 */
class m210503_103146_create_send_updates_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%send_updates_to_user}}', [
            'id_sutu' => $this->primaryKey(),
            'idkv_sutu' => $this->integer()->notNull(),
            'send_sutu' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'idkv_sutu_FK',
            '{{%send_updates_to_user}}',
            'idkv_sutu',
            'kurs_veranstaltungen',
            'id_kv',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('idkv_sutu_FK', '{{%send_updates_to_user}}');

        $this->dropTable('{{%send_updates_to_user}}');
    }
}
