<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 8/8/18
 * Time: 4:46 PM
 */

namespace abdujabbor\counter;

use abdujabbor\counter\storage\IOStorage;

class Invoker
{
    protected $event;
    protected $pdo;
    public function __construct(AbstractEventCounter $event, IOStorage $io = null)
    {
        $this->event = $event;
        $this->pdo = $io;
    }


    public function run()
    {
        if ($this->event->availableForIncrement()) {
            //$this->pdo->save($this->event->getKey(), $this->event->generateRecord());
            $this->event->incrementAmount();
            //$this->pdo->updateCounter($this->event->getKey(), $this->event->getAmount());
        }
    }
}
