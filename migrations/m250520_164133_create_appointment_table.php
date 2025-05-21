<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%appointment}}`.
 */
class m250520_164133_create_appointment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('appointment', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'doctor_id' => $this->integer()->notNull(),
            'clinic_id' => $this->integer()->notNull(),
            'start_time' => $this->dateTime(),
            'end_time' => $this->dateTime(),
            'status' => $this->string()->defaultValue('booked'),
            'price' => $this->decimal(10,2),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%appointment}}');
    }
}
