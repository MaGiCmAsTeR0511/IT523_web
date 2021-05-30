<p align="center">
        <img src=".\web\images\symbolApplikation.png">
</p>

# Webapplikation

This repository is for an University project of the Ferdinand Porsche FernFH. This is the webapplikation Site to insert courses. These courses and their details will be sent to Discord within an specific channel.


## requirements

* PHP-Version >=7.1 but  < 8
* If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix)   
* [Git](https://git-scm.com/) for Download repository 
* MySQL database was used (but it should also work on SQL and PorstgreSQL as well)


INSTALLATION
------------

### Install via Composer
You have to go in the directory where you have downloaded the repository. The following command has to be executed in a console (cmd) of your choice:
`composer install` or `composer update`. 

Now the necessary dependencies will be installed, so that the application will work properly.

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
Migrations are the way to generate Tables in your database provided by Yii.

To do this you have to run a console in your root-directory of the application. Afterwards you have to use the following command: `yii migrate`  

You will be asked if yii should execute these migrations (accept with Yes).

Now Yii will try to create the tables and foreign key for this application.


### Now your application should be ready to run on your Webserver



User Manual
-------------

To use this application you have to signup first. Therefore just enter an username, a mail address and a password.

<p align="center">
        <img src=".\web\images\usage_webapplikation\Signup_form.png">
</p>

If your user is created you will receive following message.

<p align="center">
        <img src=".\web\images\usage_webapplikation\Signup_form_result.png">
</p>

Now you should have received a mail with a link. By clicking on the link your user is enabled and you will be logged in automatically to use the application.

Now you can start creating new courses within the application. This is shown on the top menu
<p align="center">
        <img src=".\web\images\usage_webapplikation\logged_in.png">
</p>

### Course Creation

To create a course that the Discord-user can attend and register for you have to fill in the following fields.

<p align="center">
        <img src=".\web\images\usage_webapplikation\kurs_veranstaltung anlegen.png">
</p>

In "Modulveranstaltungen" you can add more modules. This can be done with the green plus. You can delete modules as well. The minimum number of modules is 1.

When the course is created you will be directed to a details-view. Here the user can find the inserted values listed again.
<p align="center">
        <img src=".\web\images\usage_webapplikation\kurs_details.png">
</p>

In this view you can update or delete courses if you want.


In you overview of all your created courses you can update or delete the course directly with the pencil_icon (update) and trash_bin (delete).

<p align="center">
        <img src=".\web\images\usage_webapplikation\kurs_veranstaltungen_überischt.png">
</p>

After you create a course it will be sent automatically to the DiscordServer.