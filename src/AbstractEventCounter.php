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

        if (!$this->validateArgs()) {
            throw new \InvalidArgumentException(sprintf("Passed invalid arguments, for lookup call method getErrors: %s", json_encode($this->getErrors())));
        }

        $this->setEvent();
        $this->generateKey();
        $this->amount = $amount;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return int
     */
    public function hasErrors()
    {
        return count($this->getErrors()) > 0;
    }


    /**
     * @param string $event
     */
    public function setEvent($event = EventTypes::EVENT_VIEW)
    {
        $this->event = $event;
    }


    /**
     * Returns key for updating record counts
     * @return mixed
     */
    protected function getKey()
    {
        return $this->key;
    }

    /**
     * method for validating input arguments, in every nested class you can write your own rules
     * @return bool
     */
    protected function validateArgs(): bool
    {
        $keys = array_keys(array_filter($this->args));
        $requiredFields = $this->getRequiredFields();
        sort($requiredFields);
        sort($keys);
        
        if (!($keys === $requiredFields)) {
            $this->errors['attributes'] = sprintf(
                "Invalid arguments passed, required fields are: %s",
                                                    implode(",", $requiredFields)
            );
        }


        return !$this->hasErrors();
    }

    /**
     * Returns value of amount of calculations
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * This method will return need fields for working and calculate event
     * @return array
     */
    protected function getRequiredFields():array
    {
        return $this->requiredFields;
    }

    /**
     * This method will be increment the value of amount of event
     * @void
     */
    public function incrementAmount(): void
    {
        $this->amount++;
    }



    /**
     * This method will generate needle key for counter, for example for postViews the postID
     * will be key for counter, for LinkClick you can get link url string as key string
     * @return string
     */
    abstract public function generateKey():string;

    /**
     * This method will generate the record about event
     * For example it can contain event, ip, timestamp, user-agent
     * @return array
     */
    abstract public function generateRecord():array;

    /**
     * This method will check is available to incrementing, for example if you want
     * calculate only unique views in current method you would write needle rules, check from table
     * if it's already exists record in table it means you would not increment the event counter
     * @return bool
     */
    abstract public function availableForIncrement(): bool;
}
