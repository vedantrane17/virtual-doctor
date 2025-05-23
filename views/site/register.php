<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-register d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 500px;">
        <h2 class="text-center mb-4"><?= Html::encode($this->title) ?></h2>
        <p class="text-center text-muted mb-4">Create your account to continue</p>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput(['placeholder' => 'Choose a username'])->label('Username') ?>

        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Your email address'])->label('Email') ?>

        <?= $form->field($model, 'password_hash')->passwordInput(['placeholder' => 'Choose a password'])->label('Password') ?>

        <?= $form->field($model, 'role')->dropDownList([
            'user' => 'User',
            'doctor' => 'Doctor',
        ], ['prompt' => 'Select Role'])->label('Register As') ?>

        <div class="d-grid mt-3">
            <?= Html::submitButton('Register', ['class' => 'btn btn-success btn-block']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <div class="text-center mt-3">
            <small class="text-muted">
                Already have an account?
                <?= Html::a('Login here', ['site/login']) ?>
            </small>
        </div>
    </div>
</div>
