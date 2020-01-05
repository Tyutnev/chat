<?php

namespace console\controllers;

use yii\console\Controller;
use Ratchet\Server\IoServer;
use console\daemon\WebSocketServer;

/**
 * Контроллер для управления чатом
 */
class ChatController extends Controller
{
    /**
     * Запуск чата
     * @param int $port
     */
    public function actionStart($port)
    {
        echo "Для отключения сокет сервера нажмите ctrl + c\n";

        (IoServer::factory(
            new WebSocketServer(),
            $port
        ))->run();
    }
}