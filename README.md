bot telegram
============
for bot telegram

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist akbarjoody/yii2-bot-telegram "*"
```

or add

```
"aki/yii2-bot-telegram": "*"
```

to the require section of your `composer.json` file.


Usage
-----
frist add to config.php

<?php
'component' => [
	'telegram' => [
           'class' => 'aki\telegram\Telegram',
           'botToken' => '123456:akkkkkkkkkkkkkkii',
           'botUsername' => 'PostManGoBot'
    ]

]
?>

Once the extension is installed, simply use it in your code by  :


<?= Yii::$app->telegram->senMessage('chat_id', 'message'); ?>