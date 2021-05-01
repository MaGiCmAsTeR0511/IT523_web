<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%modul_veranstaltungen}}`.
 */
class m210430_172015_create_modul_veranstaltungen_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%modul_veranstaltungen}}', [
            'id_mv' => $this->primaryKey(),
            'idkv_mv' => $this->integer()->notNull(),
            'von_mv' => $this->dateTime()->notNull(),
            'bis_mv' => $this->dateTime()->notNull(),
            'titel_mv' => $this->string(80)->notNull(),
            'beschreibung_mv' => $this->text(2000)->notNull(),
            'sigid_mv' => $this->integer()->notNull(),
            'sigdate_mv' => $this->dateTime()->notNull()
        ]);
    

     // add foreign key for table `user`
     $this->addForeignKey(
        'sigid_mv_FK',
        '{{%modul_veranstaltungen}}',
        'sigid_mv',
        'user',
        'id',
     );

     // add foreign key for table `kurs_veranstaltungen`
     $this->addForeignKey(
        'idkv_mv_FK',
        '{{%modul_veranstaltungen}}',
        'idkv_mv',
        'kurs_veranstaltungen',
        'id_kv',
     );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('sigid_mv_FK', '{{%modul_veranstaltungen}}');

        $this->dropForeignKey('idkv_mv_FK', '{{%modul_veranstaltungen}}');


        $this->dropTable('{{%modul_veranstaltungen}}');
    }
}
