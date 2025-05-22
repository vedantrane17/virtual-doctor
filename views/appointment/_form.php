<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Doctor;
use app\models\Clinic;

/** @var yii\web\View $this */
/** @var app\models\Appointment $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="appointment-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- Hidden user_id (auto-filled) -->
    <?= $form->field($model, 'user_id')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>

    <!-- Doctor dropdown -->
    <?= $form->field($model, 'doctor_id')->dropDownList(
        ArrayHelper::map(Doctor::find()->all(), 'id', 'name'),
        ['prompt' => 'Select a doctor']
    ) ?>

    <!-- Clinic dropdown -->
    <?= $form->field($model, 'clinic_id')->dropDownList(
        ArrayHelper::map(Clinic::find()->all(), 'id', 'name'),
        ['prompt' => 'Select a clinic']
    ) ?>

    <!-- Start Time -->
    <?= $form->field($model, 'start_time')->input('datetime-local', ['id' => 'start-time']) ?>

    <!-- End Time -->
    <?= $form->field($model, 'end_time')->input('datetime-local', ['id' => 'end-time']) ?>

    <!-- Price (auto-updated via JS) -->
    <?= $form->field($model, 'price')->textInput(['readonly' => true, 'id' => 'price']) ?>

    <!-- Optional: hidden status -->
    <?= $form->field($model, 'status')->hiddenInput(['value' => 'pending'])->label(false) ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Save Appointment', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
// JavaScript to calculate price
$script = <<<JS
function calculatePrice() {
    let start = new Date($('#start-time').val());
    let end = new Date($('#end-time').val());

    if (!start || !end || isNaN(start) || isNaN(end)) return;

    let diffMinutes = (end - start) / 60000;
    if (diffMinutes <= 0) {
        $('#price').val('');
        return;
    }

    // Example: 10 min = ₹100 inside hours, ₹300 outside (default ₹100 here)
    let rate = 100;

    // Example time logic (you can replace this with AJAX check to backend working hours)
    let startHour = start.getHours();
    if (startHour < 9 || startHour > 17) {
        rate = 300;
    }

    let total = (diffMinutes / 10) * rate;
    $('#price').val(Math.round(total));
}

$('#start-time, #end-time').on('change', calculatePrice);
JS;

$this->registerJs($script);
?>
