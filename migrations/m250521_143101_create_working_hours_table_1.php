<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%working_hours}}`.
 */
class m250521_143101_create_working_hours_table_1 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('working_hours', [
            'id' => $this->primaryKey(),
            'doctor_id' => $this->integer()->notNull(),
            'day_of_week' => $this->string()->notNull(),
            'start_time' => $this->time()->notNull(),
            'end_time' => $this->time()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-working_hours-doctor_id',
            'working_hours',
            'doctor_id',
            'doctor',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%working_hours}}');
    }
}
