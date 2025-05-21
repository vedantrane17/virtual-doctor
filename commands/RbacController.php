<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // Create roles
        $admin = $auth->createRole('admin');
        $doctor = $auth->createRole('doctor');
        $user = $auth->createRole('user');

        $auth->add($admin);
        $auth->add($doctor);
        $auth->add($user);

        // Assign admin to user ID 1
        $auth->assign($admin, 1);
    }
}
