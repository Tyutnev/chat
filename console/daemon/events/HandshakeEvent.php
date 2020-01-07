<?php

namespace console\daemon\events;

use Ratchet\ConnectionInterface;
use console\daemon\events\IEvent;
use common\models\User;

class HandshakeEvent implements IEvent
{
    /**
     * Исполнение события
     */
    public function execute(ConnectionInterface &$from, $msg, \SplObjectStorage &$clients)
    {
        /**
         * Получение идентификатора пользователя после подключения
         */
        if($from->resourceId == $msg->resourceId)
        {
            $from->id_user = User::findIdByAuthKey($msg->hash);
        }
    }
}