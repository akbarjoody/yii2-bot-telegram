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
     * Telegram may return:
     * - a Message / Chat / User object (associative array)
     * - a scalar (True, Int, String) for methods like deleteMessage,
     *   getChatMembersCount, exportChatInviteLink
     * - a list of Update objects (legacy getUpdates wrapping)
     *
     * @param mixed $value
     */
    public function setResult($value)
    {
        if (!is_array($value) && !is_object($value)) {
            $this->_result = $value;
            return;
        }

        // Numerically indexed list of updates (each item has update_id)
        if (is_array($value) && $this->isListOfUpdates($value)) {
            $this->_result = [];
            foreach ($value as $item) {
                if (is_array($item)) {
                    $this->_result[] = new Input($item);
                }
            }
            return;
        }

        $this->_result = new Result($value);
    }

    /**
     * Detect a JSON list of Update objects, not a single Message/Chat array.
     *
     * A Message is also an array, so we must not treat every array as updates
     * (that previously caused Input to be constructed with scalar field values
     * such as message_id, which triggers "Invalid argument supplied for foreach()").
     *
     * @param array $value
     * @return bool
     */
    private function isListOfUpdates(array $value): bool
    {
        if ($value === [] || !array_key_exists(0, $value)) {
            return false;
        }

        $first = $value[0];
        return is_array($first) && array_key_exists('update_id', $first);
    }
}
