<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "doctor".
 *
 * @property int $id
 * @property string $name
 * @property string $specialization
 * @property int|null $experience
 * @property array $clinic_ids (virtual property)
 *
 * @property Clinics[] $clinics
 */
class Doctor extends \yii\db\ActiveRecord
{
    // Virtual property to hold selected clinics in the form
    public $clinic_ids;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doctor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'specialization'], 'required'],
            [['experience'], 'integer'],
            [['name', 'specialization'], 'string', 'max' => 255],
            [['clinic_ids'], 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'specialization' => 'Specialization',
            'experience' => 'Experience (Years)',
            'clinic_ids' => 'Clinics',
        ];
    }

    /**
     * Relation to get assigned clinics
     */
    public function getClinics()
    {
        return $this->hasMany(Clinics::class, ['id' => 'clinic_id'])
            ->viaTable('doctor_clinic', ['doctor_id' => 'id']);
    }

    /**
     * Auto-load selected clinic IDs after model is loaded
     */
    public function afterFind()
    {
        parent::afterFind();
        $this->clinic_ids = ArrayHelper::getColumn($this->clinics, 'id');
    }

    /**
     * After saving doctor, update the doctor_clinic pivot table
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        // Delete existing clinic links
        Yii::$app->db->createCommand()->delete('doctor_clinic', ['doctor_id' => $this->id])->execute();

        // Insert new clinic links
        if (is_array($this->clinic_ids)) {
            foreach ($this->clinic_ids as $clinic_id) {
                Yii::$app->db->createCommand()->insert('doctor_clinic', [
                    'doctor_id' => $this->id,
                    'clinic_id' => $clinic_id
                ])->execute();
            }
        }
    }
}
