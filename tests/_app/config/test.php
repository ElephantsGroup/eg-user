<?php

return [
    'id' => 'eg-user-tests',
    'basePath' => dirname(__DIR__),
    'language' => 'en-US',
    'aliases' => [
        '@elephantsGroup/user' => dirname(dirname(dirname(__DIR__))),
        '@tests' => dirname(dirname(__DIR__)),
        '@vendor' => VENDOR_DIR,
        '@bower' => VENDOR_DIR . '/bower-asset',
    ],
    'bootstrap' => ['elephantsGroup\user\Bootstrap'],
    'modules' => [
        'user' => [
            'class' => 'elephantsGroup\user\Module',
            'admins' => ['user'],
        ],
    ],
    'components' => [
        'db' => require __DIR__ . '/db.php',
        'mailer' => [
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
        ],
    ],
    'params' => [],
];