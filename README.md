<p align="center">
        <img src=".\web\images\symbolApplikation.png">
</p>

# Webapplikation

This repository for an University project of the Ferdinand Porsche FernFH. This is the webapplikation Site to insert courses. This courses an dtheir Details will be send to Discord in an specific channel.


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



User Manual
-------------

To use this application you have to Signup for it. To signup you have to enter an Username, an emailadress and an password.

<p align="center">
        <img src=".\web\images\usage_webapplikation\Signup_form.png">
</p>

If your user is created you will become following message.

<p align="center">
        <img src=".\web\images\usage_webapplikation\Signup_form_result.png">
</p>

Now you schould have received an Email on your given Mailadress with an Link. Wenn you follow this link your user is enabled an you will be logged in automatically to use the applikation.

Now you can create Courses in this Applikation. This is shown on the top Menu
<p align="center">
        <img src=".\web\images\usage_webapplikation\logged_in.png">
</p>

### Course Creation

To create an Course that the DiscordUser can attend and register for this course.
To create an course you have to fill in the following fields.

<p align="center">
        <img src=".\web\images\usage_webapplikation\kurs_veranstaltung anlegen.png">
</p>

In "Modulveranstaltungen" you cann add more modules this can be done with the green plus. You can delete modules aswell. The minimum number of modules is 1.

When the Course is created you will be directed to an detailsview. Hier ar the inserted values listed again.
<p align="center">
        <img src=".\web\images\usage_webapplikation\kurs_details.png">
</p>

In this view you can update oder delted this course if you want.


In you Overview of all your created Courses you can update oder delete the course directly with the pencil_icon (update) and trash_bin (delete);

<p align="center">
        <img src=".\web\images\usage_webapplikation\kurs_veranstaltungen_überischt.png">
</p>

After you created the Course it will be automatically send to the DiscordServer. 