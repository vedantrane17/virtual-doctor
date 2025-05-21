<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%clinic}}`.
 */
class m250520_163900_create_clinic_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('clinic', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'address' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%clinic}}');
    }
}
