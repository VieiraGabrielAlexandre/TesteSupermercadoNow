<?php
	session_start();

	ini_set('default_charset','UTF-8');
	date_default_timezone_set('America/Sao_Paulo');

	require_once './tools.php';
	require_once './settings.php';
	require_once './db.php';
	require_once './users.php';
	require_once './urlhandler.php';
    require_once './uploads.php';
    require_once './pages.php';
	require_once './templates.php';
	require_once './cache.php';
?>
