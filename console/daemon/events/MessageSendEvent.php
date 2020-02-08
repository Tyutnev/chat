<?php

namespace console\daemon\events;

use Ratchet\ConnectionInterface;
use console\daemon\events\IEvent;
use common\models\User;

class MessageSendEvent implements IEvent
{
    /**
     * Исполнение события
     */
    public function execute(ConnectionInterface &$from, $msg, \SplObjectStorage &$clients)
    {
        var_dump($msg);
    }
}