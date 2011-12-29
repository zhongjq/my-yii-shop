<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

$backend=dirname(dirname(__FILE__));
$frontend=dirname($backend);
Yii::setPathOfAlias('backend', $backend);

return array(
	'basePath' => $frontend,
	'name'=>'网站后台管理程序',
	'sourceLanguage'=>'zh_cn',
	'timeZone' => 'Asia/Shanghai',

	'controllerPath' => $backend.'/controllers',
	'viewPath' => $backend.'/views',
	'runtimePath' => $backend.'/runtime',

	'import' => array(
		'backend.models.*',
		'backend.components.*',
		'application.models.*',
		'application.components.*',
		'application.extensions.*',
		//基本全局controller
		'backend.controllers.BaseController',
		//前插树遍历,无限分类
		'application.extensions.nestedset.*',
		'backend.controllers.TreeController',
		//AJAX
		'application.extensions.jformvalidate.EHtml',
		//RBAC
		'application.modules.srbac.controllers.SBaseController',
	),

	// preloading 'log' component
	'preload'=>array('log'),

	'modules'=>array(
		'srbac'=>
			array(
			// Your application's user class (default: User)
			"userclass"=>"user",
			// Your users' table user_id column (default: userid)
			"userid"=>"userid",
			// your users' table username column (default: username)
			"username"=>"username",
			// If in debug mode (default: false)
			// In debug mode every user (even guest) can admin srbac, also 
			//if you use internationalization untranslated words/phrases 
			//will be marked with a red star
			"debug"=>false,
			// The number of items shown in each page (default:15)
			"pageSize"=>16,
			// The name of the super user
			"superUser" =>"Authority",
			//The css file to use
			//"css"=>"srbac_red.css", // must be in srbac css folder
			//The layout to use
			"layout"=>"backend.views.layouts.main",
			//The not authorized page
			"notAuthorizedView"=>"backend.views.site.login",
			// The always allowed actions
			"alwaysAllowed"=>array(
				'SiteLogin','SiteLogout','SiteIndex','SiteAdmin',
				'SiteError', 'SiteContact','SiteCaptcha'
			),
			// The operationa assigned to users
			"userActions"=>array(
				"Show","View","List"
			),
			// The number of lines of the listboxes
			"listBoxNumberOfLines" => 10,
			// The path to the custom images relative to basePath (default the srbac images path)
			//"imagesPath"=>"../images",
			//The icons pack to use (noia, tango)
			"imagesPack"=>"tango",
			// Whether to show text next to the menu icons (default false)
			"iconText"=>true,
		)
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
				/*
                array(
                    'class'=>'CEmailLogRoute',
                    'levels'=>'error, warning',
                    'emails'=>'huanghuibin@gmail.com',
                ),	
                */			
			),
		),

		//验证模块
		'jformvalidate' => array (
			'class' => 'application.extensions.jformvalidate.EJFValidate'
		),
		//文件
		'file'=>array(
			'class'=>'application.extensions.file.CFile',
		),
		
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to set up database
		'db'=>array(
			'class'=>'CDbConnection',
			//'connectionString'=>'sqlite:'.$backend.'/../data/cms.db',
			// uncomment the following to use MySQL as database
			'connectionString'=>'mysql:host=127.0.0.1;dbname=yiicms',
			'username'=>'root',
			'password'=>'sa',
			'charset'=>'utf8',

			'schemaCachingDuration'=>3600,
			'enableParamLogging'=>true,			
		),

		'authManager'=>array(
			// The type of Manager (Database)
			'class'=>'CDbAuthManager',
			// The database connection used
			'connectionID'=>'db',
			// The itemTable name (default:authitem)
			'itemTable'=>'AuthItem',
			// The assignmentTable name (default:authassignment)
			'assignmentTable'=>'AuthAssignment',
			// The itemChildTable name (default:authitemchild)
			'itemChildTable'=>'AuthItemChild',
		),
		/*
		'cache'=>array(
			'class'=>'system.caching.CMemCache',
			'servers'=>array(
				array('host'=>'192.168.1.222', 'port'=>11211, 'weight'=>100),
			),
		),
		*/
		'cache'=>array(
			'class'=>'system.caching.CFileCache',
			'directoryLevel'=>'2',
			'cachePath'=>$frontend.'/runtime/cache',
		),
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>true,
			'rules'=>array(
				//'<controller:\w+>'=>'<controller>/list',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',Z
			),
		),		

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'huanghuibin@gmail.com',
	),
);
