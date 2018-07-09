Yii2 Bitcko PHPMailer
=========================================
Bitcko Yii2 PHPMailer use to send emails from your project.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require bitcko/yii2-bitcko-mailer:dev-master

```

or add

```
"bitcko/yii2-bitcko-mailer": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

1. Mailer configuration in  config/web.php for basic temp or config/main.php for advanced.

```php
<?php
'components'=> [
    ...
'BitckoMailer'=>[
            'class'=>'bitcko\mailer\BitckoMailer',
            'SMTPDebug'=> 2, // 0 to disable, optional
            'isSMTP'=>true, // default true
            'Host'=>'smtp.gmail.com', //optional
            'SMTPAuth'=>true, //optional
            'Username'=>'you google account username', //optional
            'Password'=>'your google account password', //optional
            'SMTPSecure'=>'tls', //optional, tls or ssl
            'Port'=>587, //optional, smtp server port
            'isHTML'=>true, // default true
        ],
            ...
        ]

```

2. Controller example:
      
```php
<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;

class SiteController extends Controller
{
   
  public function actionSend()
     {
 
 
         $params = [
             'from'=>['address'=>'email address','name'=>'name here'],
             'addresses'=>[
                 ['address'=>'email address','name'=>'name here']
             ],
             'body'=>'email body here',
             
              //optional              
              'subject'=>'email subject here',
               //optional
              'altBody'=>'email alt body here',
               //optional
              'addReplyTo'=>[
                  ['address'=>'email address','information'=>'info here']
              ],
               //optional
              'cc'=>[
                  'email address'
              ],
               //optional
              'bcc'=>[
                  'email address'
              ],
              //optional
              'attachments'=>[
                 // ['path'=>'','name'=>'']
              ],
         ];
         
         return Yii::$app->BitckoMailer->mail($params); // return true if mail sent successfully
 
     }
}


```



