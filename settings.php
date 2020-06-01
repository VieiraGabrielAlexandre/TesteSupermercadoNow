<?php

$config_name = getenv('CONFIG_NAME');
if (!$config_name) {
	die('missing configuration entry CONFIG_NAME.');
}
if (!tools_sane_filename($config_name)) {
	die('invalid configuration entry in CONFIG_NAME: ' . $config_name);	
}
$config_filename = dirname(__FILE__) . '/settings-' . $config_name . '.php';
if (!file_exists($config_filename)) {
	die('missing configuration file: ' . $config_filename);
}

require_once($config_filename);
$config['basedir'] = dirname(__FILE__);
