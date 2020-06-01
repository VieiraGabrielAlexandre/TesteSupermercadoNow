<?php
	$app_basedir = dirname(__FILE__);
	require_once('./bootstrap.php');

	$urlhandler_map = array();
	$urlhandler_map['#default'] = array('#callback' => 'page_homepage', '#access' => true);
	$urlhandler_map['#permission_denied'] = array('#callback' => 'pages_login_redirect', '#access' => true);
	$urlhandler_map['#pagenotfound'] = array('#callback' => 'page_not_found', '#access' => 'true');

	$urlhandler_map['ajax'] = array('#callback' => 'get_ajax', '#access' => true);

	$urlhandler_map['login'] = array('#callback' => 'page_login', '#access' => true);
	$urlhandler_map['reset-password'] = array('#callback' => 'page_reset_password', '#access' => true);
	$urlhandler_map['logout'] = array('#callback' => 'page_logout','#access' => 'pages_perm_logado');
	
	// paginas de usuario (tem que estar logado pra acessar)
	$urlhandler_map['usuario'] = array(
		'cadastro' => array('#callback' => 'page_cadastro_editar', '#access' => 'pages_perm_logado'),
	);

	$path = (isset($_GET['q']) ? $_GET['q'] : '');
	$output = urlhandler_handle_request($urlhandler_map, $path);

	if ($output) {
		if (is_array($output)) {
			if (isset($output['#json'])) {
				unset($output['#json']);
				header('Content-Type: application/json');
				print json_encode($output, JSON_FORCE_OBJECT);
			} else if (isset($output['#jsonp'])) {
				unset($output['#jsonp']);
				header('Content-Type: application/javascript');
				print json_encode($output, JSON_FORCE_OBJECT);
			} else {
				$t = array('login' => 'page-login', 'reset-password' => 'page-login');
				$e = explode('/', $path);
				if(isset($t[$e[0]])){
					print template_render($t[$e[0]], $output);	
					return true;
				}

				$template = (isset($t[$path]) ? $t[$path] : 'page');
				print template_render($template, $output);	

			}
		} else if (is_scalar($output)) {
			print template_render('page', array_merge(template_get_default_vars(), array('body' => $output)));
		}
	}
