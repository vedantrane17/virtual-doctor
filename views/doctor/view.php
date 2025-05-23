<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Doctor $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Doctors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="doctor-view">

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
            'name',
            'specialization',
            [
                'attribute' => 'experience',
                'label' => 'Experience (Years)',
            ],
            [
                'attribute' => 'user_id',
                'value' => $model->user->username ?? '(not assigned)',
                'label' => 'Username',
            ],
        ],
    ]) ?>


    <h4>Clinics:</h4>
    <ul>
    <?php foreach ($model->clinics as $clinic): ?>
        <li><?= $clinic->name ?> - <?= $clinic->address ?></li>
    <?php endforeach; ?>
    </ul>

</div>
