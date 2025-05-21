<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%holidays}}`.
 */
class m250520_164354_create_holidays_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('holidays', [
            'id' => $this->primaryKey(),
            'doctor_id' => $this->integer(),
            'date' => $this->date(),
            'reason' => $this->string(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%holidays}}');
    }
}
