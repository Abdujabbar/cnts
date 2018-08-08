<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 8/8/18
 * Time: 3:17 PM
 */

namespace abdujabbor\counter;

class ScrollDownEvent extends AbstractEventCounter
{
    protected $requiredFields = ['id'];

    /**
     * ScrollDownEvent constructor.
     * @param int $amount
     * @param array $args
     */
    public function __construct(int $amount = 0, array $args = [])
    {
        parent::__construct($amount, $args);
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
