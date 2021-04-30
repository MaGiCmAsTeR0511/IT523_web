<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_to_kursveranstaltung}}`.
 */
class m210430_172029_create_user_to_kursveranstaltung_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_to_kursveranstaltung}}', [
            'id_utkv' => $this->primaryKey(),
            'iduser_utkv' => $this->integer()->notNull(),
            'idkv_utkv' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'idkv_utkv_FK',
            '{{%user_to_kursveranstaltung}}',
            'idkv_utkv',
            'kurs_veranstaltungen',
            'id_kv',
         );

         $this->addForeignKey(
            'iduser_utkv_FK',
            '{{%user_to_kursveranstaltung}}',
            'iduser_utkv',
            'user',
            'id',
         );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('iduser_utkv_FK', '{{%user_to_kursveranstaltung}}');

        $this->dropForeignKey('idkv_utkv_FK', '{{%user_to_kursveranstaltung}}');

        $this->dropTable('{{%user_to_kursveranstaltung}}');
    }
}
