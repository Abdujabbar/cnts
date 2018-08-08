<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 8/8/18
 * Time: 12:26 PM
 */

namespace abdujabbor\counter;

class PostViewEvent extends AbstractEventCounter
{
    protected $requiredFields = ['id'];

    /**
     * PostViewEvent constructor.
     * @param int $amount
     * @param array $args
     */
    public function __construct(int $amount = 0, array $args = [])
    {
        parent::__construct($amount, $args);
        $this->setEvent(EventTypes::EVENT_VIEW);
    }

    /**
     * @return string
     */
    public function generateKey(): string
    {
        $this->key = (string) $this->args['id'];
        return $this->key;
    }

    /**
     * @return array
     */
    public function generateRecord(): array
    {
        return [
            'id' => $this->key,
            'event' => $this->event,
            'ip' => !empty($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'localhost',
            'user-agent' => !empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '',
            'timestamp' => time(),
        ];
    }

    /**
     * @return bool
     */
    public function availableForIncrement(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function validateArgs(): bool
    {
        if(parent::validateArgs()) {
            return is_numeric($this->args['id']);
        }
        return false;
    }
}
