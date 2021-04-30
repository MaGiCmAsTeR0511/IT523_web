<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%send_updates_to_dc}}`.
 */
class m210430_172100_create_send_updates_to_dc_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%send_updates_to_dc}}', [
            'id_sudc' => $this->primaryKey(),
            'idkv_sudc' => $this->integer()->notNull(),
            'send_sudc' => $this->dateTime(),
        ]);

        $this->addForeignKey(
            'idkv_sudc_FK',
            '{{%send_updates_to_dc}}',
            'idkv_sudc',
            'kurs_veranstaltungen',
            'id_kv',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('idkv_sudc_FK', '{{%send_updates_to_dc}}');

        $this->dropTable('{{%send_updates_to_dc}}');
    }
}
