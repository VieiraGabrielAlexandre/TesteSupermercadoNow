<?php
// error_reporting(E_ERROR|E_WARNING);
// error_reporting(0);
$template_vars = array();
$current_template = '2016';

$template_default_vars = array(
	'page_title' => 'SITE_NAME',
	'meta_keywords' => 'gav',
	'meta_description' => "gav.",
	'default_contact_email' => 'name@Template_PHP_Vazio.com.br',
	'default_company_title' => 'Company',
);

$config = array();
$config['baseurl'] = 'http://testesupernow.com.br';
$config['baseurl_admin'] = 'http://testesupernow.com.br/admin';
$config['path_admin'] = 'C:/xampp/htdocs/Template_PHP_Vazio.com.br/admin';

$config['base_tema'] = 'http://testesupernow.com.br/templates/'.$current_template;

$config['static_baseurl'] = 'http://testesupernow.com.br/static';
$config['static_basepath'] = 'C:/xampp/htdocs/Template_PHP_Vazio.com.br/static';

$config['media_baseurl'] = 'http://testesupernow.com.br/media';
$config['media_basepath'] = 'C:/xampp/htdocs/Template_PHP_Vazio.com.br/media';


$config['environ'] = 'gav @ gav-01';
$config['is_devel'] = 1;
$config['devel_master_password'] = 'senharoot';
$config['analytics'] = "";
$config['analytics_profile'] = "";

$config['mysql'] = array(
	'server' => 'localhost',
	'db' => 'produtos',
	'port' => 3306,
	'user' => 'root',
	'pass' => '',
);

$config['console_logfile'] = '/tmp/domain-devlocal.log';


$config['admin']['menu'] = array(

);