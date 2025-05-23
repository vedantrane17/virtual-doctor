<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Appointment $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Appointments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="appointment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',

            [
                'label' => 'Booked By',
                'value' => $model->user->username ?? '(Not available)',
            ],

            [
                'label' => 'Doctor',
                'value' => $model->doctor->name ?? '(Not assigned)',
            ],
            [
                'label' => 'Specialization',
                'value' => $model->doctor->specialization ?? '(N/A)',
            ],

            [
                'label' => 'Clinic',
                'value' => $model->clinic->name ?? '(N/A)',
            ],

            [
                'label' => 'Date',
                'value' => Yii::$app->formatter->asDate($model->start_time, 'php:Y-m-d'),
            ],
            [
                'label' => 'Start Time',
                'value' => Yii::$app->formatter->asTime($model->start_time, 'php:h:i A'),
            ],
            [
                'label' => 'End Time',
                'value' => Yii::$app->formatter->asTime($model->end_time, 'php:h:i A'),
            ],

            [
                'attribute' => 'status',
                'value' => ucfirst($model->status),
            ],

            [
                'attribute' => 'price',
                'value' => '₹' . number_format($model->price, 2),
            ],
        ],
    ]) ?>


</div>
