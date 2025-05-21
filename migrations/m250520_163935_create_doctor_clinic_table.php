<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%doctor_clinic}}`.
 */
class m250520_163935_create_doctor_clinic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('doctor_clinic', [
            'id' => $this->primaryKey(),
            'doctor_id' => $this->integer()->notNull(),
            'clinic_id' => $this->integer()->notNull(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%doctor_clinic}}');
    }
}
