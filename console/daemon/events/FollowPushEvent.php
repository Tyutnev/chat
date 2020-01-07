<?php

namespace console\daemon\events;

use console\daemon\events\IEvent;
use Ratchet\ConnectionInterface;
use common\models\User;
use common\models\Follow;

class FollowPushEvent implements IEvent
{
    /**
     * Исполнение события
     */
    public function execute(ConnectionInterface &$from, $msg, \SplObjectStorage &$clients)
    {
        $model = new Follow();
        $model->id_sender = $from->id_user;
        $model->id_recipient = $msg->id_user;
        $model->status = Follow::STATUS_ORDER;
        $model->save();

        foreach($clients as $client)
        {
            if($client->id_user == $msg->id_user)
            {
                $client->send(json_encode([
                    'header' => 'follow-push',
                    'from' => User::findById($from->id_user)->username,
                    'id_order' => Follow::find()->max('id')
                ]));
            }
        }
    }
}