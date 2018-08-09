<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 8/8/18
 * Time: 5:47 PM
 */

require_once "../vendor/autoload.php";

try {
    $linkClickCount = new \abdujabbor\counter\LinkClickEvent(0, ['link' => 'dsada', 'id' => 10]);
} catch (Exception $e) {
    echo $e->getMessage();
}
