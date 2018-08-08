<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 8/8/18
 * Time: 12:05 PM
 */
namespace abdujabbor\counter\storage;

interface Writer
{
    public function save($key = null, $args = []);
    public function updateCounter($key = null, $amount);
}
