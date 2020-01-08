<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Message;

class ChatController extends Controller
{
    public function actionIndex()
    {
        $model = new Message();

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->get()))
        {
            $model->save();
            return;
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }

    /**
     * Получние последних сообщений
     * Действие для AJAX запроса
     */
    public function actionLastMessage()
    {
        if(Yii::$app->request->isAjax)
        {
            echo json_encode(Message::getLastMessages(Yii::$app->request->get('pivot')));
            return;
        }
        $this->goHome();
    }

    /**
     * Получение сообщений
     * Действие для AJAX запроса
     */
    public function actionMessage()
    {
        if(Yii::$app->request->isAjax)
        {
            echo json_encode(Message::getMessages(
                Yii::$app->request->get('hash_user'),
                Yii::$app->request->get('pivot')
            ));
            return;
        }
        $this->goHome();
    }
}