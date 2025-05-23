<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Holidays $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="holidays-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->input('date') ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Mark as Holiday', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
