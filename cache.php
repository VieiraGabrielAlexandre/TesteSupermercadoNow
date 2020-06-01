<?php

function cache_invoke($cache_group = 'general', $fname, $params = array(), $expiration_secs = 60) {
	global $_cache_invoke_local_cache;

	if (!is_callable($fname)) {
		throw new Exception("cache_invoke: function '$fname' is not callable.", 1);
	}
	$key = 'cache:' . $cache_group . ':' . $fname . ':' .
		sha1(print_r($params, true));
	if (isset($_cache_invoke_local_cache[$key])) {
		return $_cache_invoke_local_cache[$key];
	}
	$r = call_user_func_array($fname, $params);
	$_cache_invoke_local_cache[$key] = $r;
	return $r;
}
