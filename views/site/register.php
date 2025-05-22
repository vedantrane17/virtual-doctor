<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Register';
?>

<h1>Register</h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'username')->textInput() ?>
<?= $form->field($model, 'email')->textInput() ?>
<?= $form->field($model, 'password_hash')->passwordInput()->label('Password') ?>
<?= $form->field($model, 'role')->dropDownList([
        'user' => 'User',
        'doctor' => 'Doctor',
    ], ['prompt' => 'Select Role']) ?>

<div class="form-group">
    <?= Html::submitButton('Register', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
