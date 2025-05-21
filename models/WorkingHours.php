<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "working_hours".
 *
 * @property int $id
 * @property int|null $doctor_id
 * @property string|null $day_of_week
 * @property string|null $start_time
 * @property string|null $end_time
 */
class WorkingHours extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'working_hours';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doctor_id', 'day_of_week', 'start_time', 'end_time'], 'default', 'value' => null],
            [['doctor_id'], 'integer'],
            [['start_time', 'end_time'], 'safe'],
            [['day_of_week'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doctor_id' => 'Doctor ID',
            'day_of_week' => 'Day Of Week',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
        ];
    }

}
