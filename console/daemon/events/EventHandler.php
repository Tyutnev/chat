<?php

namespace console\daemon\events;

use Ratchet\ConnectionInterface;
use console\daemon\events\IEvent;
use Exception;

/**
 * Обработчик событий
 */
class EventHandler
{
    const NAMESPACE = '\console\daemon\events\\';

    /**
     * Обработка событий по заголовку
     * 
     * Пример:
     *      $header = "follow-push";
     *      В данном случае будет вызвано событие:
     *          console\daemon\events\FollowPushEvent
     * 
     */
    public static function handle(
        $header,
        ConnectionInterface &$from, 
        $msg,
        \SplObjectStorage $clients
    )
    {
        $header = mb_convert_case($header, MB_CASE_TITLE);
        $header = preg_replace('~\-~', '', $header);

        $eventName = self::NAMESPACE . $header . 'Event';
        
        if(!class_exists($eventName))
        {
            var_dump("Event with name $eventName not found");
            die;
        }

        $event = new $eventName;

        if(!($event instanceof IEvent))
        {
            var_dump("Event $eventName doesn't implements IEvent interface");
            die;
        }

        $event->execute($from, $msg, $clients);
    }
}