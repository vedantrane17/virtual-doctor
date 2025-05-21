<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Clinic;

/** @var yii\web\View $this */
/** @var app\models\Doctor $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="doctor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'specialization')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'experience')->textInput(['type' => 'number']) ?>

    <?php
    // Fetch all clinics from the database
    $clinicList = ArrayHelper::map(Clinic::find()->all(), 'id', 'name');
    ?>

    <?= $form->field($model, 'clinic_ids')->listBox($clinicList, [
        'multiple' => true,
        'size' => 5,
    ])->label('Assigned Clinics') ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
