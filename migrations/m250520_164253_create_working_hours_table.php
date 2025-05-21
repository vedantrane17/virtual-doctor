<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%working_hours}}`.
 */
class m250520_164253_create_working_hours_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('working_hours', [
            'id' => $this->primaryKey(),
            'doctor_id' => $this->integer(),
            'day_of_week' => $this->string(),
            'start_time' => $this->time(),
            'end_time' => $this->time(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%working_hours}}');
    }
}
