<h1 align="center">
Yii2 bot telegram
</h1>
<p align="center">
	<img width="200px" src="https://i.ibb.co/JQxDZWH/telegram.png">
</p>
<p align="center">

[![Latest Stable Version](https://poser.pugx.org/aki/yii2-bot-telegram/version)](//packagist.org/packages/aki/yii2-bot-telegram)
[![Total Downloads](https://poser.pugx.org/aki/yii2-bot-telegram/downloads)](https://packagist.org/packages/aki/yii2-bot-telegram)
[![Latest Unstable Version](https://poser.pugx.org/aki/yii2-bot-telegram/v/unstable)](https://packagist.org/packages/aki/yii2-bot-telegram)
[![License](https://poser.pugx.org/aki/yii2-bot-telegram/license)](https://packagist.org/packages/aki/yii2-bot-telegram)
[![Monthly Downloads](https://poser.pugx.org/aki/yii2-bot-telegram/d/monthly)](https://packagist.org/packages/aki/yii2-bot-telegram)
[![Daily Downloads](https://poser.pugx.org/aki/yii2-bot-telegram/d/daily)](//packagist.org/packages/aki/yii2-bot-telegram)
</p>

## نصب

روش پیشنهادی برای نصب این افزونه از طریق [composer](http://getcomposer.org/download/) است.

یکی از دستورهای زیر را اجرا کنید:

```
php composer.phar require aki/yii2-bot-telegram "*"
```

یا این مورد را به بخش `require` فایل `composer.json` اضافه کنید:

```
"aki/yii2-bot-telegram": "*"
```

## فهرست متدهای قابل استفاده

```
getMe
sendMessage
forwardMessage
sendPhoto
sendAudio
sendDocument
sendSticker
sendVideo
sendLocation
sendChatAction
getUserProfilePhotos
getUpdates
setWebhook
getChat
getChatAdministrators
getChatMembersCount
getChatMember
answerCallbackQuery
editMessageText
editMessageCaption
sendGame
Game
Animation
CallbackGame
getGameHighScores
GameHighScore
answerInlineQuery
setChatStickerSet
deleteChatStickerSet
leaveChat
pinChatMessage
unpinChatMessage
setChatDescription
setChatTitle
deleteChatPhoto 
exportChatInviteLink 
promoteChatMember
restrictChatMember
unbanChatMember
kickChatMember
editMessageLiveLocation
stopMessageLiveLocation
```

## نحوه استفاده

ابتدا در `config.php` اضافه کنید:

```php
<?php
'components' => [
    'telegram' => [
        'class' => 'aki\telegram\Telegram',
        'botToken' => '112488045:AAGs6CVXgaqC92pvt1u0L6Azfsdfd',
    ]
]
?>
```

پس از نصب افزونه، کافی است در کد خود به این شکل از آن استفاده کنید:

```php
<?php Yii::$app->telegram->sendMessage([
	'chat_id' => $chat_id,
	'text' => 'test',
]); ?>
```

ارسال پیام همراه با کیبورد اینلاین:

```php
<?php Yii::$app->telegram->sendMessage([
        'chat_id' => $chat_id,
        'text' => 'this is test',
        'reply_markup' => json_encode([
            'inline_keyboard'=>[
                [
                    ['text'=>"refresh",'callback_data'=> time()]
                ]
            ]
        ]),
    ]); ?>
```

ارسال عکس:

```php
<?php 
Yii::$app->telegram->sendPhoto([
	'chat_id' => $chat_id,
	'photo' => Yii::$app->getBaseUrl().'/uploads/test.jpg',
	'caption' => 'this is test'
]); ?>
```

ارسال فایل صوتی از مسیر محلی:

```php
<?php
Yii::$app->telegram->sendAudio([
	'chat_id' => $chat_id,
	'audio' => Yii::getAlias('@webroot') . '/uploads/music.mp3',
	'caption' => 'نمونه فایل صوتی'
]); ?>
```

## استفاده در Controller

ابتدا باید `enableCsrfValidation` را در کنترلر غیرفعال کنید.

ربات از سرور شما کار می‌کند؛ اما وقتی کاربر در اپلیکیشن تلگرام دستور `/start` را می‌زند، درخواست به اکشن کنترلر نمی‌رسد، چون تلگرام درخواست را با متد POST و بدون CSRF می‌فرستد و Yii خطای Bad Request (#400) برمی‌گرداند.

```php
class SiteController extends Controller
{
	public $enableCsrfValidation = false;

	public function actionIndex()
    {
        $res = Yii::$app->telegram->sendMessage([
            'chat_id' => $chat_id,
            'text' => 'hello world!!' 
        ]);
       
    }
}
```

## :bulb: نمونه کد:

### چطور chat_id کاربر را از ربات بگیریم؟

>__می‌توانید از `$telegram->input->message->chat->id` برای دریافت chat_id استفاده کنید.__

نمونه:

```php
$res = Yii::$app->telegram->sendMessage([
	'chat_id' => $telegram->input->message->chat->id,
	'text' => "salam"
]);
```

## :gem: قابلیت جدید Command

نحوه استفاده از دستور (Command):

```php
use aki\telegram\base\Command;

Command::run("/start", function($telegram){
   $result = $telegram->sendMessage([
      'chat_id' => $telegram->input->message->chat->id,
      "text" => "hello"
   ]);
});
```
