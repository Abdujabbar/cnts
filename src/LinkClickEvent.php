<?php
/**
 * Created by PhpStorm.
 * User: abdujabbor
 * Date: 8/8/18
 * Time: 1:50 PM
 */

namespace abdujabbor\counter;

class LinkClickEvent extends AbstractEventCounter
{
    protected $requiredFields = ['id', 'link'];

    /**
     * LinkClickEvent constructor.
     * @param int $amount
     * @param array $args
     */
    public function __construct(int $amount = 0, array $args = [])
    {
        parent::__construct($amount, $args);
        $this->setEvent(EventTypes::EVENT_CLICK);
    }

    /**
     * @return string
     */
    public function generateKey(): string
    {
        return (string) $this->args['link'];
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
    protected function validateArgs(): bool
    {
        if(parent::validateArgs()) {
            if(filter_var($this->args['link'], FILTER_VALIDATE_URL)) {
                $this->errors['link'] = "Link must be url string";
            }
        }
        return $this->hasErrors();
    }
}
