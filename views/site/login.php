<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 450px;">
        <h2 class="text-center mb-4"><?= Html::encode($this->title) ?></h2>
        <p class="text-center text-muted mb-4">Enter your credentials to continue</p>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
        ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Enter your username'])->label('Username') ?>

        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Enter your password'])->label('Password') ?>

        <?= $form->field($model, 'rememberMe')->checkbox()->label('Remember me') ?>

        <div class="d-grid mt-3">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <div class="text-center mt-3">
            <small class="text-muted">
                Don't have an account?
                <?= Html::a('Register here', ['site/register']) ?>
            </small>
        </div>
    </div>
</div>
