<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 8/8/18
 * Time: 6:05 PM
 */

class LinkClickEventTest extends \PHPUnit\Framework\TestCase
{
    public function testInvalidParams()
    {
        $this->expectException('\InvalidArgumentException');
        $linkClickEvent = new \abdujabbor\counter\LinkClickEvent(0,
                                                                    ['link' => 'huhuhu', 'id' => 10]);
    }

    public function testIncrementAmount()
    {
        $linkClickEvent = new \abdujabbor\counter\LinkClickEvent(0,
                                                                ['link' => 'http://google.com', 'id' => 10]);
        $invoker = new \abdujabbor\counter\Invoker($linkClickEvent);
        $invoker->run();
        $this->assertSame(1, $linkClickEvent->getAmount());


    }
}