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
    public function __construct(AbstractEventCounter $event)
    {
        $this->event = $event;
    }


    public function run()
    {
        $this->event->execute();
    }
}
