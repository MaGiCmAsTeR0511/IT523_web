<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%signup}}`.
 */
class m210426_170550_create_signup_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%signup}}', [
            'id' => $this->primaryKey(),
            'mail' => $this->string()->notNull(),
            'token' => $this->string()->notNull(),
            'invalid_date' => $this->dateTime()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%signup}}');
    }
}
