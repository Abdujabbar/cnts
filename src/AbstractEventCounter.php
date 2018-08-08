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

    /**
     * AbstractEventCounter constructor.
     * @param IOStream $io
     * @param array $args
     */
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

    /**
     * @param string $event
     */
    public function setEvent($event = EventTypes::EVENT_VIEW)
    {
        $this->event = $event;
    }

    /**
     * @return bool
     */
    public function addRecord():bool
    {
        return $this->ioStream->save($this->key, $this->generateRecord());
    }

    /**
     * @return bool
     */
    public function updateCounter():bool
    {
        return $this->ioStream->updateCounter($this->getKey(), $this->amount);
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
    public function validateInputParams(): bool
    {
        $keys = array_keys(array_filter($this->args));
        return $keys === $this->requiredFields;
    }

    /**
     * @return array
     */
    public function getRequiredFields():array
    {
        return $this->requiredFields;
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
