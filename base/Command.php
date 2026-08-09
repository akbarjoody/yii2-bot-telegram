<?php

namespace aki\telegram\base;

use Yii;
use yii\base\Component;

/**
 * Simple text-command router for webhook bots.
 *
 * @author Akbar Joudi <akbar.joody@gmail.com>
 */
class Command extends Component
{
    /**
     * Run a handler when the incoming message text matches $command.
     *
     * @param string $command Exact first token, e.g. "/start"
     * @param callable $fun function(Telegram $telegram, array $args)
     * @return mixed|null
     */
    public static function run($command, callable $fun)
    {
        $telegram = Yii::$app->telegram;
        $input = $telegram->input ?? null;
        if ($input === null || empty($input->message) || empty($input->message->text)) {
            return null;
        }

        $args = preg_split('/\s+/', trim($input->message->text), -1, PREG_SPLIT_NO_EMPTY);
        if ($args === false || $args === []) {
            return null;
        }

        $inputCommand = array_shift($args);
        // Strip @BotUsername from /command@BotUsername
        if (strpos($inputCommand, '@') !== false) {
            $inputCommand = strstr($inputCommand, '@', true);
        }

        if ($inputCommand === $command) {
            return call_user_func($fun, $telegram, $args);
        }

        return null;
    }
}
