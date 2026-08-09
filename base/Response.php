<?php

namespace aki\telegram\base;

use aki\telegram\types\Result;

/**
 * 
 */
class Response extends Type
{
    /**
     * 
     */
    public $ok;

    /**
     * 
     */
    private $_result;

    public $error_code;

    public $description;

    public function getResult()
    {
        return $this->_result;
    }

    /**
     * Telegram may return a Message object, or a scalar (True, Int, String)
     * for methods like deleteMessage, getChatMembersCount, exportChatInviteLink.
     *
     * @param mixed $value
     */
    public function setResult($value)
    {
        if (!is_array($value) && !is_object($value)) {
            $this->_result = $value;
        } else {
            $this->_result = new Result($value);
        }
    }
}
