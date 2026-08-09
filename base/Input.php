<?php /** @noinspection PhpUnused */

namespace aki\telegram\base;

use aki\telegram\types\CallbackQuery;
use aki\telegram\types\Chat;
use aki\telegram\types\From;
use aki\telegram\types\Message;

/**
 * Incoming Update from Telegram (webhook or getUpdates item).
 *
 * Unknown / newer update fields are still available as public properties
 * via {@see Type::__set} ignore-unknown behavior when declared, or as raw arrays.
 *
 * @author Akbar Joudi <akbar.joody@gmail.com>
 *
 * @property Message|null $message
 * @property Message|null $edited_message
 * @property Message|null $channel_post
 * @property Message|null $edited_channel_post
 * @property Message|null $business_message
 * @property Message|null $edited_business_message
 * @property Message|null $guest_message
 * @property CallbackQuery|null $callback_query
 * @property From|null $from
 * @property Chat|null $chat
 */
class Input extends Type
{
    public $update_id;

    private $_message;
    private $_edited_message;
    private $_channel_post;
    private $_edited_channel_post;
    private $_business_message;
    private $_edited_business_message;
    private $_guest_message;
    private $_callback_query;
    private $_from;
    private $_chat;

    /** @var array|null */
    public $inline_query;

    /** @var array|null */
    public $chosen_inline_result;

    /** @var array|null */
    public $shipping_query;

    /** @var array|null */
    public $pre_checkout_query;

    /** @var array|null */
    public $poll;

    /** @var array|null */
    public $poll_answer;

    /** @var array|null */
    public $my_chat_member;

    /** @var array|null */
    public $chat_member;

    /** @var array|null */
    public $chat_join_request;

    /** @var array|null */
    public $message_reaction;

    /** @var array|null */
    public $message_reaction_count;

    /** @var array|null */
    public $chat_boost;

    /** @var array|null */
    public $removed_chat_boost;

    /** @var array|null */
    public $business_connection;

    /** @var array|null */
    public $deleted_business_messages;

    /** @var array|null */
    public $purchased_paid_media;

    /** @var array|null */
    public $managed_bot;

    /** @var array|null */
    public $subscription;

    public function getMessage()
    {
        return $this->_message;
    }

    public function setMessage($value): void
    {
        $this->_message = $value instanceof Message ? $value : new Message($value);
    }

    public function getEdited_message()
    {
        return $this->_edited_message;
    }

    public function setEdited_message($value): void
    {
        $this->_edited_message = $value instanceof Message ? $value : new Message($value);
    }

    public function getChannel_post()
    {
        return $this->_channel_post;
    }

    public function setChannel_post($value): void
    {
        $this->_channel_post = $value instanceof Message ? $value : new Message($value);
    }

    public function getEdited_channel_post()
    {
        return $this->_edited_channel_post;
    }

    public function setEdited_channel_post($value): void
    {
        $this->_edited_channel_post = $value instanceof Message ? $value : new Message($value);
    }

    public function getBusiness_message()
    {
        return $this->_business_message;
    }

    public function setBusiness_message($value): void
    {
        $this->_business_message = $value instanceof Message ? $value : new Message($value);
    }

    public function getEdited_business_message()
    {
        return $this->_edited_business_message;
    }

    public function setEdited_business_message($value): void
    {
        $this->_edited_business_message = $value instanceof Message ? $value : new Message($value);
    }

    public function getGuest_message()
    {
        return $this->_guest_message;
    }

    public function setGuest_message($value): void
    {
        $this->_guest_message = $value instanceof Message ? $value : new Message($value);
    }

    public function getCallback_query()
    {
        return $this->_callback_query;
    }

    public function setCallback_query($value): void
    {
        $this->_callback_query = $value instanceof CallbackQuery ? $value : new CallbackQuery($value);
    }

    public function getFrom()
    {
        return $this->_from;
    }

    public function setFrom($value): void
    {
        $this->_from = $value instanceof From ? $value : new From($value);
    }

    public function getChat()
    {
        return $this->_chat;
    }

    public function setChat($value): void
    {
        $this->_chat = $value instanceof Chat ? $value : new Chat($value);
    }
}
