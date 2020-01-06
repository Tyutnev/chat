<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\LoginForm;
use common\models\RegistrationForm;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'registration', 'exit'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['exit'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['login', 'registration'],
                        'roles' => ['?'],
                    ]
                ]
            ],
        ];
    }

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
        
        $formData = Yii::$app->request->post();
        $formName = 'RegistrationForm';

        if(Yii::$app->request->isAjax && $registrationForm->load($formData))
        {
            if($registrationForm->save())
            {
                $loginForm = new LoginForm();
                $loginForm->load($formData, $formName);
                $loginForm->login();

                echo json_encode(json_encode(['status' => 'success']));

                return;
            }
            echo json_encode(['status' => 'error', 'errors' => $registrationForm->getErrors()]);
            return;
        }
    }

    public function actionIdentity()
    {
        if(Yii::$app->request->isAjax && !Yii::$app->user->isGuest)
        {
            echo Yii::$app->user->getIdentity()->getAuthKey();
        }
    }

    public function actionExit()
    {
        if(Yii::$app->user->logout())
        {
            $this->goHome();
        }
    }
}