<?php
/** @var yii\web\View $this */
$this->title = 'Virtual Doctor Appointment System';
?>

<div class="site-index">

    <div class="bg-primary text-white text-center py-5 shadow rounded mb-5">
        <h1 class="display-4 fw-bold">Virtual Doctor Appointment System</h1>
        <p class="lead mt-3">Book appointments, manage schedules, and simplify patient care.</p>
        <a href="<?= \yii\helpers\Url::to(['site/login']) ?>" class="btn btn-light btn-lg mt-3">Get Started</a>
    </div>

    <div class="container text-center">
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">👤 Users</h5>
                        <p class="card-text">Browse doctors, view schedules, and book appointments easily from anywhere.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">🧑‍⚕️ Doctors</h5>
                        <p class="card-text">Manage your appointments, accept or reject requests, and update your availability.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">🛠️ Admin</h5>
                        <p class="card-text">Monitor users, doctors, and appointments. Full access to system management.</p>
                    </div>
                </div>
            </div>
        </div>

        <p class="text-muted mt-5">Built with <strong>Yii2 Framework</strong>, using RBAC for secure access control.</p>
    </div>
</div>
