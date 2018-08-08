<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 8/8/18
 * Time: 5:47 PM
 */

require_once "../vendor/autoload.php";
try {
    $linkClickEvent = new \abdujabbor\counter\LinkClickEvent(0,
        ['link' => 'http://google.com', 'id' => 10]);
} catch (Exception $e) {
    echo $e->getMessage();
}

//var_dump($linkClickEvent->getErrors());