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
    protected $errors = [];

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

        if (!$this->validateArgs()) {
            throw new \InvalidArgumentException(sprintf("Passed invalid arguments, for lookup call method getErrors: %s", json_encode($this->getErrors())));
        }
    }

    /**
     * @return array
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * @return int
     */
    public function hasErrors() {
        return count($this->getErrors());
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
    protected function validateArgs(): bool
    {
        $keys = array_keys(array_filter($this->args));
        if(!$keys === $this->requiredFields) {
            $this->errors['attributes'] = "Required fields doesn't passed";
        }
        return !$this->hasErrors();
    }

    /**
     * @return int
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * @return array
     */
    protected function getRequiredFields():array
    {
        return $this->requiredFields;
    }

    /**
     * @void
     */
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
     * @return bool
     */
    abstract public function availableForIncrement(): bool;
}
