<?php
@include dirname(__FILE__) . '/universities.php';
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

define('MENU_ELEMENT_VISIBLE', 'visible');
define('MENU_ELEMENT_NEED_AUTH', 'need_auth');

Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

$config = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'АСУ',

	'preload'=>array('log', 'shortcodes'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.bootstrap.*',
		'application.extensions.behaviors.*',
		'ext.elFinder.*',
		'ext.EScriptBoost.*',
		'ext.LangPick.*',
	),

	'modules'=>array(
		'admin',
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'urlManager'=>array(
			'showScriptName' => false,
			'urlFormat' => 'path',
			'rules'=>array(
				'' => 'site/index',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=cleanapp',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'schemaCachingDuration' => !YII_DEBUG ? 86400 : 0,
			'enableParamLogging' => YII_DEBUG,
		),
		'cache' => array(
			'class' => 'CFileCache',
		),
		/*'assetManager' => array(
			'class' => 'ext.EAssetManagerBoostGz',
			'minifiedExtensionFlags' => array('min.js', 'minified.js', 'packed.js'),
		),*/
		'clientScript'=>array(
			'packages' => array(
				'jquery' => array( // jQuery CDN - provided by (mt) Media Temple
					'baseUrl' => 'js/',
					'js' => array(YII_DEBUG ? 'jquery-1.11.0.js' : 'jquery-1.11.0.min.js'),
				),
                'chosen' => array(
                    'baseUrl' => 'theme/ace/assets/chosen',
                    //'css' => array('css/chosen.css'),
                    //'js' => array('js/uncompressed/chosen.jquery.js'),
					'css' => array('chosen.min.css'),
					'js' => array('chosen.jquery.min.js'),
                    'depends' => array('jquery')
                ),
                'gritter' => array(
                    'baseUrl' => 'theme/ace/assets/',
                    'css' => array('css/jquery.gritter.css'),
                    'js' => array('js/jquery.gritter.min.js'),
                    'depends' => array('jquery')
                ),
                'spin' => array(
                    'baseUrl' => 'theme/ace/assets/',
                    'js' => array('js/spin.min.js'),
                    'depends' => array('jquery')
                ),
                'jqgrid' => array(
                    'baseUrl' => 'theme/ace/assets/',
                    'css' => array('css/ui.jqgrid.css'),
                    'js' => array('js/jqGrid/jquery.jqGrid.min.js'),
                    'depends' => array('jquery')
                ),
                'dataTables' => array(
                    'baseUrl' => 'theme/ace/assets/',
                    'js' => array('js/jquery.dataTables.min1.js', 'js/jquery.dataTables.bootstrap.js'),
                    //'css' => array('css/jquery.dataTables2.css'),
                    'depends' => array('jquery')
                ),
                'daterangepicker' => array(
                    'baseUrl' => 'theme/ace/assets/',
                    'css' => array('css/daterangepicker.css'),
                    'js' => array('js/date-time/daterangepicker.min.js', 'js/date-time/moment.min.js'),
                    'depends' => array('jquery')
                ),
                'datepicker' => array(
                    'baseUrl' => 'theme/ace/assets/',
                    'css' => array('css/datepicker.css'),
                    'js' => array('js/date-time/bootstrap-datepicker.min.js', 'js/date-time/locales/bootstrap-datepicker.ru.js'),
                    'depends' => array('jquery')
                ),
				'datepicker-mobile' => array(
						'baseUrl' => '/',
						'css' => array('css/mobile/datepicker/bootstrap-datepicker3.min.css','css/mobile/datepicker/bootstrap-datepicker3.standalone.min.css'),
						'js' => array('js/mobile/datepicker/js/bootstrap-datepicker.min.js'),
						//'depends' => array('jquery')
				),
                'autosize' => array(
                    'baseUrl' => 'theme/ace/assets/',
                    'js' => array('js/jquery.autosize-min.js'),
                    'depends'=>array('jquery'),
                ),
                'jquery.ui' => array(
                    'baseUrl' => 'theme/ace/assets/',
                    'css' => array('css/jquery-ui-1.10.3.full.min.css'),
                    'js' => array('js/jquery-ui-1.10.3.full.min.js'),
                    'depends'=>array('jquery'),
                ),
                'jqplot' => array(
                    'baseUrl' => 'theme/ace/assets/',
                    'css' => array('css/jquery.jqplot.css'),
                    'js' => array(
                        'js/jqplot/jquery.jqplot.js',
                        'js/jqplot/jqplot.highlighter.js',
                        'js/jqplot/jqplot.cursor.js',
                        'js/jqplot/jqplot.dateAxisRenderer.js',
                    ),
                    'depends'=>array('jquery'),
                ),
                'nestable' => array(
                    'baseUrl' => 'theme/ace/assets/',
                    'js' => array('js/jquery.nestable.min.js'),
                    'depends'=>array('jquery'),
                ),
                'jquery2' => array(
                    'baseUrl' => 'theme/ace/assets/',
                    'js' => array('js/jquery-2.0.3.min.js'),
                ),
                'form-wizard' => array(
                    'baseUrl' => 'theme/ace/assets/',
                    'css' => array('css/select2.css'),
                    'js' => array(
                        'js/fuelux/fuelux.wizard.min.js',
                        'js/jquery.validate.min.js',
                        'js/additional-methods.min.js',
                        'js/bootbox.min.js',
                        'js/select2.min.js'
                    ),
                    'depends'=>array('jquery'),
                ),
                'autocomplete' => array(
                    'baseUrl' => 'js/',
                    'js' => array('jquery.autocomplete.js'),
                    'depends'=>array('jquery'),
                ),
            ),
			'behaviors' => array(
				array(
					'class' => 'ext.behaviors.localscripts.LocalScriptsBehavior',
					'publishJs' => !YII_DEBUG,
					// Uncomment this if your css don't use relative links
					// 'publishCss' => !YII_DEBUG,
				),
			),
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
				/*array(
					'class'=>'application.extensions.yii-debug-toolbar.YiiDebugToolbarRoute',
					//'ipFilters'=>array('77.121.11.10'),
					//'ipFilters'=>array('109.87.233.112'),
					//'ipFilters'=>array('93.78.170.140'),
				),*/
			),
		),
        'bootstrap' => array(
            'class' => 'ext.bootstrap.components.Bootstrap',
        ),
        'shortcodes' => array(
            'class'=>'ShortCodes',
        ),
        'user' => array(
            'class' => 'WebUser',
        ),
	),

    'sourceLanguage'=>'ru',

	'params'=>
		array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
        'defaultLanguage'=>'ru',
        'siteUrl' => '',
        'code' => null,
        'antiPlagiarism' => array(
            'company_name' => null,
            'apicorp_address' => null,
            'antiplagiat_uri' => null,
        )
    )+require(dirname(__FILE__).'/params.php'),
);

// Apply local config modifications
@include dirname(__FILE__) . '/main-local.php';

$config['components']['db2'] = $config['components']['db'];
$config['components']['db2']['connectionString'] = $config['components']['db']['connectionString'].'D';

return $config;
