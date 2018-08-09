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
        $this->key = $this->args['key'];
        return $this->key;
    }

    /**
     * @return array
     */
    public function generateRecord(): array
    {
        return [];
    }



    /**
     * @return bool
     */
    public function availableForIncrement(): bool
    {
        return true;
    }

    public function validateArgs(): bool
    {
        return parent::validateArgs();
    }
}
