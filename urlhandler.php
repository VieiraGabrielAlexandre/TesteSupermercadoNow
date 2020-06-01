<?php

define('LANGUAGE_DEFAULT', 'en');

function set_language($lang) {
 global $language;
 $language = $lang;
}

function get_language() {
 	global $language;
 	$user = get_logged_user();
	if(!isset($user['idioma']))
		return $language;
	else
		return $user['idioma']; 
}

// $language = array(
//  'en' => 'en',
//  'pt' => 'pt',
//  'es' => 'es',
// );


// $path = (isset($_GET['q']) ? $_GET['q'] : '');
// $u = explode('/', $path);

// if (isset($language[@$u[0]])) {
//  set_language($u[0]);
//  unset($u[0]);
//  $path = implode('/', $u);
// } else {
// 		set_language(LANGUAGE_DEFAULT);
// 	if($path !="ajax"){
// 		Header("Location:/".get_language()."/".$path);
// 		exit;
// 	}
 
// }


function urlhandler_lookup($urlhandler_map, $url) {
	$urlpieces = array_filter(explode('/', $url));
	if (!$urlpieces) {
		return array('#menu' => $urlhandler_map['#default'], '#params' => array());
	}
	$p = $urlhandler_map;
	$found = 0;
	while (sizeof($urlpieces)) {
		$urlpiece = $urlpieces[0];
		if (isset($p[$urlpiece])) {
			$p = $p[$urlpiece];
			array_shift($urlpieces);
			$found++;
			continue;
		} else {
			break;
		}
	}
	if (!$found) {
		return array('#menu' => $urlhandler_map['#pagenotfound'], 
			'#params' => $urlpieces);
	}
	if (isset($p['#redirect'])) {
		return urlhandler_lookup($urlhandler_map, $p['#redirect']);
	}
	if (!isset($p['#callback'])) {
		$p = $urlhandler_map['#default'];
	}
	return array('#menu' => $p, '#params' => $urlpieces);
}

function urlhandler_handle_request($urlhandler_map, $url) {

	$m = urlhandler_lookup($urlhandler_map, $url);
	$has_access = false;

	if (isset($m['#menu']['#access'])) {
		if (is_bool($m['#menu']['#access']) || is_numeric($m['#menu']['#access'])) {
			$has_access = intval($m['#menu']['#access']);
		}

		if (is_string($m['#menu']['#access'])) {
			if (function_exists($m['#menu']['#access'])) {
				$has_access = call_user_func_array($m['#menu']['#access'], array($url, $m));
			}
		}
	}
	if (!$has_access) {
		return call_user_func_array($urlhandler_map['#permission_denied']['#callback'], array($url, $m));
	}
	if (function_exists($m['#menu']['#callback'])) {
		return call_user_func_array($m['#menu']['#callback'], $m['#params']);
	} else {
		trigger_error("Invalid callback for menu '{$url}'", E_USER_NOTICE);
	}
	return null;
}

$urlhandler_map = array();
