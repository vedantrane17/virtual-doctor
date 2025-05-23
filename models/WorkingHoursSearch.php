<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WorkingHours;

/**
 * WorkingHourSearch represents the model behind the search form of `app\models\WorkingHours`.
 */
class WorkingHoursSearch extends WorkingHours
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'doctor_id'], 'integer'],
            [['day_of_week', 'start_time', 'end_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = WorkingHours::find();


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'doctor_id' => $this->doctor_id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ]);

        $query->andFilterWhere(['like', 'day_of_week', $this->day_of_week]);

        return $dataProvider;
    }
}
