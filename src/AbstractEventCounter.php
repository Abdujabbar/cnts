<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 8/8/18
 * Time: 11:08 AM
 */
namespace abdujabbor\counter;

abstract class AbstractEventCounter
{
    protected $event;
    protected $key;
    protected $args = [];
    protected $requiredFields = [];
    protected $amount;

    /**
     * AbstractEventCounter constructor.
     * @param int $amount
     * @param array $args
     */
    public function __construct($amount = 0, $args = [])
    {
        $this->args = $args;
        $this->setEvent();
        $this->generateKey();
        $this->amount = $amount;

        if (!$this->validateInputParams()) {
            throw new \InvalidArgumentException(sprintf("Passed arguments invalid, please make sure that "));
        }
    }


    /**
     * @param string $event
     */
    public function setEvent($event = EventTypes::EVENT_VIEW)
    {
        $this->event = $event;
    }


    /**
     * @return mixed
     */
    protected function getKey()
    {
        return $this->key;
    }

    /**
     * @return bool
     */
    protected function validateInputParams(): bool
    {
        $keys = array_keys(array_filter($this->args));
        return $keys === $this->requiredFields;
    }

    /**
     * @return array
     */
    protected function getRequiredFields():array
    {
        return $this->requiredFields;
    }

    public function incrementAmount(): void
    {
        $this->amount++;
    }

    /**
     * @return string
     */
    abstract public function generateKey():string;

    /**
     * @return array
     */
    abstract public function generateRecord():array;

    /**
     * @return int
     */
    abstract public function getAmount():int;

    /**
     * @return bool
     */
    abstract public function availableForIncrement(): bool;
}
