<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 8/8/18
 * Time: 2:16 PM
 */

namespace abdujabbor\counter;

interface ICounter
{
    public function getAmount():int;
    public function incrementAmount():void;
    public function availableForIncrement(): bool;
}
