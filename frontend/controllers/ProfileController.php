<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\User;
use common\models\Follow;

class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDetail($id)
    {
        return $this->render('detail', [
            'model' => User::findById($id)
        ]);
    }

    public function actionFollowOrder()
    {
        if(Yii::$app->request->isAjax)
        {
            echo json_encode(Follow::getOrders(Yii::$app->user->getId()));
        }
    }
}