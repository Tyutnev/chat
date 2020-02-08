<?php

namespace console\daemon\events;

use Ratchet\ConnectionInterface;

/**
 * Интерфейс для событий
 */
interface IEvent
{
    /**
     * Исполнение события
     */
    public function execute(ConnectionInterface &$from, $msg, \SplObjectStorage &$clients);
};