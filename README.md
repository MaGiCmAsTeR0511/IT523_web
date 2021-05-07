<p align="center">
        <img src=".\web\images\symbolApplikation.png">
</p>


## requirements

* PHP-Version >=7.1 but  < 8
* If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix)   
* [Git](https://git-scm.com/) for Download repository 
* Database i used an Mysql database but it schoould alos work on SQL, Porstgres as well


INSTALLATION
------------

### Install via Composer
You have to go in the Directory you have downloaded the repository. Then you need to run following Command in an cmd of your Choice.
`composer install` or `composer update`. 

Now the necessary Dependencies will be installed that the Applikation will work properly.

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.
- Check and edit the other files in the `config/` directory to customize your application as required.

### Mail

Edit the file `config/mailer.php` with real data, for  Example
```php
    return [
    'class' => 'yii\swiftmailer\Mailer',
    'useFileTransport' => false,
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'smtp.yii2.application',
        'username' => 'yii2',
        'password' => '1234',
        'port' => '999',
        'encryption' => 'tls',
    ],
];
```

### Run Migrations
Migrations are the Way that Yii provides to generate Tables in your database.

To do this you have to run a console in your root-Directory of the application then you have to use this command: yii migrate  

You will be asked if yii should axecute this migrations you have to accept this with Yes.

Now Yii will try to create the Tables and Foreign Key for this applikation.


### Now your Applikation should be ready to run on your Webserver
