<?php

use app\models\Appointment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\AppointmentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Appointments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appointment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Appointment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
    ['class' => 'yii\grid\SerialColumn'],

    [
        'label' => 'Booked By',
        'value' => function ($model) {
            return $model->user->username ?? '(unknown)';
        }
    ],

    [
        'label' => 'Doctor',
        'value' => function ($model) {
            return $model->doctor->name ?? '(not assigned)';
        }
    ],

    [
        'label' => 'Date',
        'value' => function ($model) {
            return Yii::$app->formatter->asDate($model->start_time, 'php:Y-m-d');
        }
    ],

    [
        'label' => 'Start Time',
        'value' => function ($model) {
            return Yii::$app->formatter->asTime($model->start_time, 'php:h:i A');
        }
    ],

    [
        'attribute' => 'status',
        'value' => function ($model) {
            return ucfirst($model->status);
        }
    ],

    [
        'attribute' => 'price',
        'value' => function ($model) {
            return '₹' . number_format($model->price, 2);
        }
    ],

    [
        'class' => \yii\grid\ActionColumn::className(),
        'urlCreator' => function ($action, \app\models\Appointment $model, $key, $index, $column) {
            return Url::toRoute([$action, 'id' => $model->id]);
        }
    ],
],


    ]); ?>


</div>
