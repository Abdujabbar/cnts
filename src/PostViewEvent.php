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
        $browser = get_browser();
        return [
            'id' => $this->key,
            'event' => $this->event,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'browser' => $browser['browser'],
            'platform' => $browser['platform'],
            'version' => $browser['version'],
            'time' => time(),
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
