<?php

@include dirname(__FILE__) . '/universities.php';

/*$config['modules']['gii'] = array(
	'class'=>'system.gii.GiiModule',
	'password' => false,
	// If removed, Gii defaults to localhost only. Edit carefully to taste.
	'ipFilters'=>array('127.0.0.1','::1'),
);*/

$group = &$config['components']['db'];
$group = array_merge($group, array(
    'connectionString' => 'firebird:dbname=localhost:/path/to/db',
    'class' => 'ext.YiiFirebird.CFirebirdConnection',
    'username' => '',
    'password' => '',
));

// yiidebugtb
/*$config['components']['log']['routes'][] = array(
	'class'=>'ext.yiidebugtb.XWebDebugRouter',
	'config'=>'alignLeft, opaque, runInDebug, fixedPos, collapsed, yamlStyle',
	'levels'=>'error, warning, trace, profile, info',
	'allowedIPs'=>array('127.0.0.1','::1'),
);*/
$config['components']['log']['routes'][] = array(
    'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
    'levels'=>'error, warning, trace, profile, info',
    'enabled' => YII_DEBUG,
    'ipFilters'=>array('*'),
);
$config['components']['log']['routes'][] = array(
    'class'=>'CWebLogRoute',
    'categories'=>'system.db.CDbCommand',
    'showInFireBug'=>false,
    'enabled'=>false
);
$config['components']['db']['enableProfiling'] = true;
$config['components']['db']['enableParamLogging'] = true;

if (YII_DEBUG)
    $config['modules']['gii'] =
        array(
            'class'=>'system.gii.GiiModule',
            'password'=>'123',
            'generatorPaths'=>array(
                'bootstrap.gii',
            ),
        );

$config['params']['code'] = '';
