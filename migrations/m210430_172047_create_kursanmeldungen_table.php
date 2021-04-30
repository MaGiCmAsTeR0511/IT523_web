<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kursanmledungen}}`.
 */
class m210430_172047_create_kursanmeldungen_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%kursanmeldungen}}', [
            'id_ka' => $this->primaryKey(),
            'iddc_ka' => $this->string(255)->notNull(),
            'idkv_ka' => $this->integer()->notNull(),
            'deleted_ka' => $this->boolean()
        ]);

        $this->addForeignKey(
            'idkv_ka_FK',
            '{{%kursanmeldungen}}',
            'idkv_ka',
            'kurs_veranstaltungen',
            'id_kv',
         );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('idkv_ka_FK', '{{%kursanmeldungen}}');

        $this->dropTable('{{%kursanmledungen}}');
    }
}
