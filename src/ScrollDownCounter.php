<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 8/8/18
 * Time: 3:17 PM
 */

namespace abdujabbor\counter;


use abdujabbor\counter\io\IOStream;

class ScrollDownCounter extends AbstractEventCounter
{
    protected $requiredFields = ['id'];

    public function __construct(IOStream $io, array $args = [])
    {
        parent::__construct($io, $args);
        $this->setEvent(EventTypes::EVENT_SCROLL_DOWN);
    }

    /**
     * @return string
     */
    public function generateKey(): string
    {
        // TODO: Implement generateKey() method.
    }

    /**
     * @return array
     */
    public function generateRecord(): array
    {
        // TODO: Implement generateRecord() method.
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        // TODO: Implement getAmount() method.
    }

    /**
     * @return bool
     */
    public function availableForIncrement(): bool
    {
        // TODO: Implement availableForIncrement() method.
    }
}