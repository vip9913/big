<?php
	return [
		'id' => 'funnel-web',
	    'basePath' => realpath (__DIR__ . '/../'),
        'bootstrap' => ['debug'],
        'components' => [
            'request' => [
                'cookieValidationKey' => 'super secret funnel code'
            ],
            'urlManager' => [
                'class' => 'codemix\localeurls\UrlManager',
                'languages' => ['ru', 'en'],
                'enableDefaultLanguageUrlCode' => true,
                'enablePrettyUrl' => true,
                'showScriptName' => false
            ],
        ],
        'modules' => [
            'debug' => 'yii\debug\Module'
        ]

    ];
