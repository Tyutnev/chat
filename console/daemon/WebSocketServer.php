<?php

namespace console\daemon;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use console\daemon\events\EventHandler;
use common\models\Connect;

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
        EventHandler::handle($msg->header, $from, $msg, $this->clients);
    }

    public function onClose(ConnectionInterface $conn) {    
        foreach($this->clients as $client)
        {
            if($client->resourceId == $conn->resourceId)
            {
                Connect::offline($client->id_user);
            }
        }

        $this->clients->detach($conn);
        echo "Close, user has id: $conn->resourceId\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }
}