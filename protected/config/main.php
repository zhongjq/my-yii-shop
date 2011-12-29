<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'网站测试版 BETA',
	'sourceLanguage'=>'zh_cn',
	'timeZone' => 'Asia/Shanghai',	
	//'layout'=>'old',
	'theme'=>'school',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		//前插树遍历,无限分类
		'application.extensions.nestedset.*',
	),

	// application components
	'components'=>array(
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to set up database
		/*
		'db'=>array(
			'connectionString'=>'Your DSN',
		),
		*/
		'db'=>array(
			'class'=>'CDbConnection',
			//'connectionString'=>'sqlite:'.dirname(__FILE__).'/../data/cms.db',
			// uncomment the following to use MySQL as database
			'connectionString'=>'mysql:host=127.0.0.1;dbname=yiicms',
			'username'=>'root',
			'password'=>'sa',
			'charset'=>'utf8',

			'schemaCachingDuration'=>3600,
			'enableParamLogging'=>true,
		),
        'cache'=>array(
            'class'=>'system.caching.CFileCache',
			'directoryLevel'=>'2',
        ),
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,
            'rules'=>array(
                //'<controller:\w+>'=>'<controller>/list',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                '<controller:\w+>/<id:\d+>/<title>'=>'<controller>/view',
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/cate_id/<cate_id:\d+>'=>'<controller>/list',
				
				'teacher'=>'product/list/cate_id/25',
				'student'=>'product/list/cate_id/26',
            ),
        ),


	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),

);
