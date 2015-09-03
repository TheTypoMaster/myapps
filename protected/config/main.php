<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
//Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');


// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'CAD SYSTEM',

	// path aliases
    'aliases' => array(
        
        // yiistrap configuration
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'), // change if necessary
        // yiiwheels configuration
        'yiiwheels' => realpath(__DIR__ . '/../extensions/yiiwheels'), // change if necessary

        ),

	// preloading 'log' component
	'preload'=>array('log'),


	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		 'bootstrap.helpers.TbHtml',
	),

	'modules'=>array(
	
	'message' => array(
            'userModel' => 'User',
            'getNameMethod' => 'getFullName',
            'getSuggestMethod' => 'getSuggest',
			
        ),
		
		'receiverRelation' => array(
    CActiveRecord::BELONGS_TO, 
    'MyUserModel',
    '',
    'on' => 'MyUserModel.my_custom_id = receiver_id'
 ),
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
	
	'Smtpmail'=>array(
            'class'=>'application.extensions.smtpmail.PHPMailer',
            'Host'=>"smtp.gmail.com",
            'Username'=>'toyol1990@gmail.com',
            'Password'=>'kematian',
            'Mailer'=>'smtp',
            'Port'=>587,
            'SMTPAuth'=>true, 
			  'SMTPSecure' => 'tls',
        ),

		 // yiistrap configuration
        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ), 
        // yiiwheels configuration
        'yiiwheels' => array(
            'class' => 'yiiwheels.YiiWheels',   
        ),
        
        //Excel View
        'excel'=>array(
        'class'=>'application.extensions.PHPExcel',
        ),
	
/*	'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
		
		*/
		'user'=>array(
		'class'=>'application.components.EWebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
	
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/cads.db',
		),
		*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=yii_tour',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '12345',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);