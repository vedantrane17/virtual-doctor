<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Today\'s Appointments';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="appointment-today">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Patient',
                'value' => function ($model) {
                    return $model->user->username ?? 'N/A';
                },
            ],
            [
                'label' => 'Start Time',
                'value' => function ($model) {
                    return Yii::$app->formatter->asTime($model->start_time, 'php:h:i A');
                },
            ],
            [
                'label' => 'End Time',
                'value' => function ($model) {
                    return Yii::$app->formatter->asTime($model->end_time, 'php:h:i A');
                },
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return ucfirst($model->status);
                },
            ],
        ],
    ]); ?>
</div>
