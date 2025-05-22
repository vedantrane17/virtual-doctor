<?php
/** @var app\models\Appointment $model */
?>

<h2>Appointment Confirmation</h2>
<p><strong>Doctor:</strong> <?= $model->doctor->name ?? 'N/A' ?></p>
<p><strong>Clinic:</strong> <?= $model->clinic->name ?? 'N/A' ?></p>
<p><strong>Date:</strong> <?= Yii::$app->formatter->asDatetime($model->start_time) ?></p>
<p><strong>Status:</strong> <?= ucfirst($model->status) ?></p>
<p><strong>Price:</strong> ₹<?= $model->price ?></p>
