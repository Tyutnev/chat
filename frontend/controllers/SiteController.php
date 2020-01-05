<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\LoginForm;
use common\models\RegistrationForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function actionLogin()
    {
        $loginForm = new LoginForm();
        $registrationForm = new RegistrationForm();

        if(Yii::$app->request->isAjax && $loginForm->load(Yii::$app->request->post()))
        {
            echo $loginForm->login() ? json_encode(['status' => 'success']) :
                                       json_encode(['status' => 'error', 'errors' => $loginForm->getErrors()]);
            return;
        }

        return $this->render('login', [
            'loginForm' => $loginForm,
            'registrationForm' => $registrationForm
        ]);
    }

    public function actionRegistration()
    {
        $registrationForm = new RegistrationForm();

        if(Yii::$app->request->isAjax && $registrationForm->load(Yii::$app->request->post()))
        {
            echo $registrationForm->save() ? json_encode(['status' => 'success']) :
                                              json_encode(['status' => 'error', 'errors' => $registrationForm->getErrors()]);

            return;
        }
    }
}