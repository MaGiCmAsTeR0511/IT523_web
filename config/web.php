<?php


$params = require __DIR__ . '/params.php';
if (file_exists( __DIR__ . '/dblocal.php')) {
    $db = require __DIR__ . '/dblocal.php';
} else {
    
    $db = require __DIR__ . '/db.php';
}


$config = [
    'id' => 'IT523',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'kJCoXvUWz256mhpBESyZSvXS1v3jpjFe',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'site/login',
                'debug/<controller>/<action>' => 'debug/<controller>/<action>',
                'login' => 'login',
                'logout' => 'site/logout',
                'autocomplete' => 'site/autocomplete',
                'person/<id:\d+>' => 'person/mitarbeiter/anzeigen',
                'person/einheit/aufteilen/<id:\d+>' => 'person/einheit/aufteilen',
                'tools/signaturgenerator/<id:\d+>' => 'tools/signaturgenerator',
                'honorarnotenana/rkanastpf/honorarnoten/<status:\d+>' => 'honorarnotenana/rkanastpf/honorarnoten',
                'honorarnotenana/rkanastpf/details/<id:\d+>/<vorschlag:\d+>' => 'honorarnotenana/rkanastpf/details',
                'honorarnotenana/rkanastpf/release/<id:\d+>' => 'honorarnotenana/rkanastpf/release',
                'honorarnotenana/rkanastpf/reject/<id:\d+>' => 'honorarnotenana/rkanastpf/reject',
                'honorarnotenana/rkanastpf/honorarnoten/<status:\d+>' => 'honorarnotenana/rkanastpf/honorarnoten',
                'honorarnotenana/rkanastpf/stpldetails/<id:\d+>/<vorschlag:\d+>' => 'honorarnotenana/rkanastpf/stpldetails',
                'honorarnotenana/rkanalvf/honorarnoten/<status:\d+>' => 'honorarnotenana/rkanalvf/honorarnoten',
                'honorarnotenana/rkanalvf/showpdf/<id:\d+>/<statusid:\d+>' => 'honorarnotenana/rkanalvf/showpdf',
                'honorarnotenana/rkanahn/showpdf/<id:\d+>/<statusid:\d+>' => 'honorarnotenana/rkanahn/showpdf',
                'fluechtlingsbetreuung/rkflanwesenheitskontrolle/scannen/<fbid:[0-9]+>/<date:\d+>' => 'fluechtlingsbetreuung/rkflanwesenheitskontrolle/scannen',
                'person/einheit/aufteilen-save/<id:\d+>' => 'person/einheit/aufteilen-save',
                'person/<controller:\w+>/<subcategory:\w+>/anzeigen/<id:\d+>' => '<controller>/<action>',
                'personalverwaltung/<controller:\w+>' => 'person/<controller>',
                'personalverwaltung/<controller:\w+>/<action:\w+>' => 'person/<controller>/<action>',
                'person/<controller:\w+>/<action:\w+>/<id:[a-zA-Z0-9]+>' => 'person/<controller>/<action>',
                'person/rkdienstausweis/mgzubeenden/<id:[a-zA-Z0-9]+>/<mgnr:\d+>/<dzvon:\d+>' => 'person/rkdienstausweis/mgzubeenden',
                'person/rkdienstausweis/chipbeenden/<id:[a-zA-Z0-9]+>/<dczvon:\d+>' => 'person/rkdienstausweis/chipbeenden',
                'personalverwaltungyii/personendaten/updatemailerreichbarkeit/<mgnr:\d+>/<pos:\d+>' => 'personalverwaltungyii/personendaten/updatemailerreichbarkeit',
                'personalverwaltungyii/personendaten/deleteemailerreichbarkeit/<mgnr:\d+>/<pos:\d+>' => 'personalverwaltungyii/personendaten/deleteemailerreichbarkeit',
                'personalverwaltungyii/personendaten/updatetelerreichbarkeit/<mgnr:\d+>/<pos:\d+>' => 'personalverwaltungyii/personendaten/updatetelerreichbarkeit',
                'personalverwaltungyii/personendaten/deletetelerreichbarkeit/<mgnr:\d+>/<pos:\d+>' => 'personalverwaltungyii/personendaten/deletetelerreichbarkeit',
                'zdldpw/<controller:\w+>/<action:\w+>' => 'zdldpw/<controller>/<action>',
                'fluechtlingsbetreuung/rkflpersonen/bearbeiten/<id:[0-9]+>' => 'fluechtlingsbetreuung/rkflpersonen/bearbeiten',
                'fluechtlingsbetreuung/rkflpersonen/betreustelle/<id:[0-9]+>' => 'fluechtlingsbetreuung/rkflpersonen/betreustelle',
                'fluechtlingsbetreuung/betreustellehinzufuegen/<id:[0-9]+>' => 'fluechtlingsbetreuung/betreustellehinzufuegen',
                'fluechtlingsbetreuung/rkflpersonen/betreustellebearbeiten/<fbid:[0-9]+>/<fpid:[0-9]+>/<pbvon:[0-9]+>' => 'fluechtlingsbetreuung/rkflpersonen/betreustellebearbeiten',
                'fluechtlingsbetreuung/rkflpersonen/managebetreustelle/<id:[0-9]+>' => 'fluechtlingsbetreuung/managebetreustelle',
                'fluechtlingsbetreuung/ubersetzerbearbeiten/<id:[0-9]+>' => 'fluechtlingsbetreuung/ubersetzerbearbeiten',
                'fluechtlingsbetreuung/rkflanwesenheitskontrolle/personbearbeiten/<id:[0-9]+>' => 'fluechtlingsbetreuung/rkflanwesenheitskontrolle/personbearbeiten',
                'rps/hauptberuflichea/update/<HE_MG_NR:\d+>/<HE_ID:\d+>' => 'rps/hauptberuflichea/update',
                'tankrechnungen/rechnungen/rechnungdetailsbyuser/<rid:[0-9]+>/<mgnr:[0-9]+>' => 'tankrechnungen/rechnungen/rechnungdetailsbyuser',
                'jrk/gruppen/managemg/<id:[0-9]+>/<filterid:[0-9]+>' => 'jrk/gruppen/managemg',
                'jrk/veranstaltungen/editveranstaltungen/<id:[0-9]+>/<gid:[0-9]+>' => 'jrk/veranstaltungen/editveranstaltungen',
                'jrk/veranstaltungen/veracheckin/<vid:[0-9]+>/<gid:[0-9]+>' => 'jrk/veranstaltungen/veracheckin',
                'jrk/veranstaltungen/veracheckinedit/<vid:[0-9]+>/<gid:[0-9]+>' => 'jrk/veranstaltungen/veracheckinedit',
                'jrk/veranstaltungen/verabewerbe/<vid:[0-9]+>/<gid:[0-9]+>' => 'jrk/veranstaltungen/verabewerbe',
                'jrk/veranstaltungen/addgroup/<vid:[0-9]+>/<gid:[0-9]+>/<bid:[0-9]+>' => 'jrk/veranstaltungen/addgroup',
                'jrk/veranstaltungen/editgroup/<vid:[0-9]+>/<gid:[0-9]+>/<bid:[0-9]+>' => 'jrk/veranstaltungen/editgroup',
                'jrk/veranstaltungen/bewerbgruppen/<bid:[0-9]+>/<vid:[0-9]+>' => 'jrk/veranstaltungen/bewerbgruppen',
                'tools/bstverzeichnis/download/<file:[a-zA-Z0-9]+>/<extension:[a-z]+>' => 'tools/bstverzeichnis/download',
                'usn/sozialbegleitungen/ajax-end-begleitung/<id:\d+><ende:\d+>' => 'usn/sozialbegleitungen/ajax-end-begleitung',
                'honorarnoten/honorarnotenerneut/anfordern/<mvtid:\d+>/<mvtpnr:\d+>' => 'honorarnoten/honorarnotenerneut/anfordern',
                'sammelcontroller/checkiban' => 'sammelcontroller/checkiban',
                'berechtigungen/rpsberechtigung/updaterpsabteilung/<mgnr:\d+>/<abtid:\d+>' => 'berechtigungen/rpsberechtigung/updaterpsabteilung',
                'lagerds/dsbestellung/create/<id:\d+>/<dsnr:\d+>/<eid:\d+>' => 'lagerds/dsbestellung/create',
                'lagerds/dsbestellung/detail/<id:\d+>/<dsnr:\d+>/<eid:\d+>' => 'lagerds/dsbestellung/detail',
                'lagerds/produktbestellung/saveform/<id:\d+>/<dsnr:\d+>' => 'lagerds/produktbestellung/saveform',
                'lagerds/produktbestellung/saveformnoorder/<id:\d+>/<dsnr:\d+>' => 'lagerds/produktbestellung/saveformnoorder',
                'covidtester/dsbestellung/create/<id:\d+>/<dsnr:\d+>' => 'covidtester/dsbestellung/create',
                'covidtester/dsbestellung/detail/<id:\d+>/<dsnr:\d+>' => 'covidtester/dsbestellung/detail',
                'covidtester/produktbestellung/saveform/<id:\d+>/<dsnr:\d+>' => 'covidtester/produktbestellung/saveform',
                'gsdlagerbestand/dsbestellung/create/<id:\d+>/<dsnr:\d+>' => 'gsdlagerbestand/dsbestellung/create',
                'gsdlagerbestand/dsbestellung/detail/<id:\d+>/<dsnr:\d+>' => 'gsdlagerbestand/dsbestellung/detail',
                'gsdlagerbestand/produktbestellung/saveform/<id:\d+>/<dsnr:\d+>' => 'gsdlagerbestand/produktbestellung/saveform',
                'entgeltfortzahlung/entmaeinsatz/dienstbeleg/<file:[a-zA-Z0-9]+>' => 'entgeltfortzahlung/entmaeinsatz/dienstbeleg',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>/<detail:\d+>' => '<module>/<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>/<detail:\d+>/<all:\d+>' => '<module>/<controller>/<action>',
            ],
        ],
        
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
