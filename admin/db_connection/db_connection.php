<?php
// database constants
//define('DB_DRIVER', 'mysql');
//define('DB_SERVER', 'hasantha8857379.ipagemysql.com');
//define('DB_SERVER_USERNAME', 'resumemates');
//define('DB_SERVER_PASSWORD', 'VinuriRM@2023');
//define('DB_DATABASE', 'db_resumemates');

// local
define('DB_DRIVER', 'mysql');
define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'root');
define('DB_SERVER_PASSWORD', '');
define('DB_DATABASE', 'db_kakkutaika');

$dboptions = array(
    PDO::ATTR_PERSISTENT => FALSE,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

try {
  $DB = new PDO(DB_DRIVER . ':host=' . DB_SERVER . ';dbname=' . DB_DATABASE, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, $dboptions);
} catch (Exception $ex) {
  echo $ex->getMessage();
  die;
}

/* set base url */
//define('BASE_URL', 'https://www.kakkutaika.com');
define('BASE_URL', 'http://localhost/kakkutaika');
//define('BASE_URL', 'https://devsite.investorthinkonline.com');
define('ADMIN_URL', BASE_URL.'/admin/');
$widgateData = simplexml_load_file(BASE_URL."/admin/config.xml");
foreach ($widgateData->config as $configItems) {
	if($configItems->attributes()->name == "config_dev"){
		$preview = $configItems->content;
	} else if($configItems->attributes()->name == "config_live"){
		$live = $configItems->content;
	}
}

$server = (DB_SERVER != 'localhost') ? $live : $preview ;
define('SERVER', $server);
define('LIVE_SERVER', $live);

//session_start();

?>