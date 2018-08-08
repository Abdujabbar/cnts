<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 8/8/18
 * Time: 11:08 AM
 */
namespace abdujabbor\counter;

use abdujabbor\counter\io\IOStream;

abstract class AbstractEventCounter
{
    protected $event;
    protected $key;
    protected $args = [];
    protected $requiredFields = [];
    protected $amount;
    protected $ioStream;
    public function __construct(IOStream $io, $args = [])
    {
        $this->args = $args;
        $this->setEvent();
        $this->generateKey();
        $this->ioStream = $io;
        $this->amount = $this->ioStream->get($this->getKey());

        if (!$this->validateInputParams()) {
            throw new \InvalidArgumentException(sprintf("Passed arguments invalid, please make sure that "));
        }
    }

    public function setEvent($event = EventTypes::EVENT_VIEW)
    {
        $this->event = $event;
    }

    public function addRecord():bool
    {
        return $this->ioStream->save($this->key, $this->generateRecord());
    }

    public function updateCounter():bool
    {
        return $this->ioStream->updateCounter($this->getKey(), $this->amount);
    }


    protected function getKey()
    {
        return $this->key;
    }

    public function validateInputParams(): bool
    {
        $keys = array_keys(array_filter($this->args));
        return $keys === $this->requiredFields;
    }

    public function getRequiredFields():array
    {
        return $this->requiredFields;
    }

    public function setAmount($amount = 0)
    {
        $this->amount = $amount;
    }

    public function incrementAmount(): void
    {
        if ($this->availableForIncrement()) {
            $this->addRecord();
            $this->amount++;
            $this->updateCounter();
        }
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
