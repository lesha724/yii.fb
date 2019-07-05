<?php

$mainConfig = include dirname(__FILE__) . '/main.php';

$config = array(
	'basePath' => $mainConfig['basePath'],
	'name'     => $mainConfig['name'],
	'import'   => $mainConfig['import'],
	
	'preload' => $mainConfig['preload'],

	'components' => array(
		'cache' => $mainConfig['components']['cache'],
		'db'    => $mainConfig['components']['db'],
        'db2'    => $mainConfig['components']['db2'],
		'log'   => $mainConfig['components']['log'],
        'shortcodes'   => $mainConfig['components']['shortcodes'],
        'core'   => $mainConfig['components']['core'],
        'mobileDetect'   => $mainConfig['components']['mobileDetect'],
	),
	
	'commandMap' => array(
		'migrate' => array(
			'class'        => 'application.commands.ChMigrateCommand',
			'templateFile' => 'application.migrations.template',
		),
        'message' => array(
            'class' => 'application.commands.ttMessageCommand'
        )
	),

	'params' => $mainConfig['params'],
);

$config['components']['db']['connectionString'] .= ';role=RDB$ADMIN';
$config['components']['db2']['connectionString'] .= ';role=RDB$ADMIN';

return $config;