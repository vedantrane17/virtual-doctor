<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "appointment".
 *
 * @property int $id
 * @property int $user_id
 * @property int $doctor_id
 * @property int $clinic_id
 * @property string|null $start_time
 * @property string|null $end_time
 * @property string|null $status
 * @property float|null $price
 */
class Appointment extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appointment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'doctor_id', 'clinic_id', 'start_time', 'end_time', 'price'], 'required'],
            [['start_time', 'end_time'], 'safe'],
            [['price'], 'number'],
            [['status'], 'string'],
            [['start_time'], 'validateSlot'],
        ];
    }

    public function validateSlot($attribute, $params)
    {
        $exists = self::find()
            ->where(['doctor_id' => $this->doctor_id])
            ->andWhere(['clinic_id' => $this->clinic_id])
            ->andWhere(['between', 'start_time', $this->start_time, $this->end_time])
            ->exists();

        if ($exists) {
            $this->addError($attribute, 'This time slot is already booked.');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'doctor_id' => 'Doctor ID',
            'clinic_id' => 'Clinic ID',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'status' => 'Status',
            'price' => 'Price',
        ];
    }

    public function getDoctor()
    {
        return $this->hasOne(Doctor::class, ['id' => 'doctor_id']);
    }


}
