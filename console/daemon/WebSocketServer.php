<?php

namespace console\daemon;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use common\models\User;
use common\models\Follow;

/**
 * Веб-сокет сервер
 */
class WebSocketServer implements MessageComponentInterface
{
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);

        $conn->send(json_encode([
            'header' => 'handshake',
            'resource' => $conn->resourceId
        ]));

        echo "Open, user has id: $conn->resourceId\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $msg = json_decode($msg);

        /**
         * Получение идентификатора пользователя после подключения
         */
        if($msg->header == 'handshake' && 
           $from->resourceId == $msg->resourceId
        )
        {
            $from->id_user = User::findIdByAuthKey($msg->hash);
        }

        /**
         * Добавление в друзья
         */
        if($msg->header == 'follow')
        {
            $model = new Follow();
            $model->id_sender = $from->id_user;
            $model->id_recipient = $msg->id_user;
            $model->status = Follow::STATUS_ORDER;
            $model->save();

            foreach($this->clients as $client)
            {
                if($client->id_user == $msg->id_user)
                {
                    $client->send(json_encode([
                        'header' => 'follow-push',
                        'from' => User::findById($from->id_user)->username
                    ]));
                }
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Close, user has id: $conn->resourceId\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }
}