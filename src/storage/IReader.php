<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 8/8/18
 * Time: 1:58 PM
 */

namespace abdujabbor\counter\storage;

interface Reader
{
    public function get($key);
}
