<?php
	session_start();

	ini_set('default_charset','UTF-8');
	date_default_timezone_set('America/Sao_Paulo');

	$is_admin = true;

	require_once '../tools.php';
	require_once '../settings.php';
	require_once '../db.php';
	require_once '../encode.php';
	require_once '../users.php';
	require_once '../urlhandler.php';

	// if($config_name !="devlocal") require_once $config['path_site'].'/amazons3.php';

    require_once '../uploads.php';
    require_once '../pages.php';
	require_once './ssp.class.php';
    require_once './forms.php';
    require_once './pages_admin.php';
	require_once '../templates.php';
	require_once '../cache.php';

?>
