<?php

namespace console\daemon\events;

use console\daemon\events\IEvent;
use Ratchet\ConnectionInterface;
use common\models\User;
use common\models\Follow;

class FollowConfirmEvent implements IEvent
{
    /**
     * Исполнение события
     */
    public function execute(ConnectionInterface &$from, $msg, \SplObjectStorage &$clients)
    {
        $follow = Follow::getOrderById($msg->id_follow);
        $follow->status = $msg->accept ? Follow::STATUS_FRENDS : Follow::STATUS_DECLINED;
        $follow->save();

        foreach($clients as $client)
        {
            if($client->id_user == $follow->id_sender)
            {
                $client->send(json_encode([
                    'header' => 'follow-confirm-push',
                    'from' => User::findById($from->id_user)->username,
                    'accept' => $msg->accept
                ]));
            }
        }
    }
}