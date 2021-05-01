<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%kurs_veranstaltungen}}`.
 */
class m210430_170743_create_kurs_veranstaltungen_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%kurs_veranstaltungen}}', [
            'id_kv' => $this->primaryKey(),
            'titel_kv' => $this->string(45)->notNull(),
            'von_kv' => $this->date()->notNull(),
            'bis_kv' => $this->date()->notNull(),
            'beschreibung_kv' => $this->text(30000)->notNull(),
            'sigdate_kv' => $this->dateTime()->notNull(),
            'sigid_kv' => $this->integer()->notNull(),
            'deleted_kv' => $this->boolean()->notNull()
        ]);

        // add foreign key for table `user`
        $this->addForeignKey(
            'sigid_kv_FK',
            '{{%kurs_veranstaltungen}}',
            'sigid_kv',
            'user',
            'id',
        );



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         // drops index for column `sigid_kv`
         $this->dropForeignKey('sigid_kv_FK', '{{%kurs_veranstaltungen}}');


        $this->dropTable('{{%kurs_veranstaltungen}}');
    }
}
