<?php

ini_set('mongo.native_long', 1);

$mongo_cache = array();

# TODO: rename to $_db_mysql_query_*
$_db_query_count = 0;
$_db_query_time = 0;

function db_mysql_table_info($table) {
	$tables = array(
		'users' => array(
			'uid' => 'ID do usuario',
			'nome' => 'nome do usuario',
		),
		

	);
	
	if (!isset($tables[$table])) {
		throw new Exception("Missing table definition for table: $table", 1);
		return array();
	}
	return $tables[$table];
}


function db_mysql_init() {
	global $config, $_db_mysql_link;

	// if ($_db_mysql_link) {
	// 	return $_db_mysql_link;
	// }
	
	if (!isset($config['mysql'])) {
		fatal("database not configured.");
	}
	extract($config['mysql']);
	if ($server == 'localhost') {
		$_db_mysql_link = mysqli_connect($server, $user, $pass);
	} else {
		$_db_mysql_link = mysqli_connect($server, $user, $pass);
	}
	if (!$_db_mysql_link) {
		fatal("error connecting to database.");
	}
	if (!mysqli_select_db($_db_mysql_link, $db)) {
		$reason = db_mysql_error();
		$errno = db_mysql_errno();
		fatal("error selecting database '$db' (#{$errno} $reason)");
	}
	return $_db_mysql_link;
}

function db_mysql_query($_query = '', $args = array(), $debug = false) {
	global $_db_query_count, $_db_query_time, $_db_mysql_link;

	db_mysql_init();
	$_args = array();
	if (is_array($args) && $args) {
		$_args = array_map('db_mysql_escape', $args);
		$query = call_user_func_array('sprintf', array_merge(array($_query), $_args));
	} else {
		$query = $prepared = $_query;
	}	
	$timer_start = gettimeofday(true);
	$q = mysqli_query($_db_mysql_link, $query);
	$timer_duration = (gettimeofday(true) - $timer_start);
	$_db_query_time += $timer_duration;
	$_db_query_count++;
	if ($debug) {
		echo $query."\n";
		$log = array('duration' => sprintf('%01.3f', $timer_duration));
		if ($nr = db_mysql_num_rows($q)) {
			$log['rows'] = $nr;
		}
		if ($er = db_mysql_error()) {
			$log['error'] = $er;
			$log['backtrace'] = debug_backtrace();
		}
		console_log("executed query #{$_db_query_count}: {$query} => " . print_r($log, true));
	}
	return $q;
}

function db_mysql_success() {
	global $_db_mysql_link;
	return mysqli_errno($_db_mysql_link) == 0;
}

function db_mysql_insert($table, $data, $debug = false) {
	if (!$table || !$data) {
		return false;
	}
	if (!db_mysql_init()) {
		return false;
	}
	$fields = array();
	$values = array();
	foreach ($data as $fieldname => $value) {
		$value = db_mysql_escape($value);
		$values[] = "'{$value}'";
		$fields[$fieldname] = "`{$fieldname}`";
	}
	$fields = implode(',', $fields);
	$values = implode(',', $values);
	$query = db_mysql_query("INSERT INTO `{$table}` (" . $fields .') VALUES (' .
		$values . ')', array(), $debug);
	return db_mysql_success();
}

function db_mysql_last_insert_id() {
	global $_db_mysql_link;
	return mysqli_insert_id($_db_mysql_link);
}

function db_mysql_error() {
	global $_db_mysql_link;
	return mysqli_error($_db_mysql_link);
}

function db_mysql_errno() {
	global $_db_mysql_link;
	return mysqli_errno($_db_mysql_link);
}

function db_mysql_escape($text) {
	global $_db_mysql_link;
	return mysqli_real_escape_string($_db_mysql_link, $text);
}

function db_mysql_fetch($query) {
	return mysqli_fetch_assoc($query);
}

function db_mysql_affected_rows() {
	global $_db_mysql_link;
	return mysqli_affected_rows($_db_mysql_link);
}

function db_mysql_num_rows($query) {
	/*
	if (!is_resource($query)) {
		throw new Exception("invalid query supplied to db_mysql_num_rows()!");
	}
	*/
	return @mysqli_num_rows($query);
}

function db_mysql_save($table, $data, $debug = false) {
	if (!$table || !$data) {
		return false;
	}
	if (!db_mysql_init()) {
		return false;
	}
	$fields = array();
	$updatefields = array();
	$values = array();
	foreach ($data as $fieldname => $value) {
		$value = db_mysql_escape($value);
		$values[] = "'{$value}'";
		$fields[$fieldname] = "`{$fieldname}`";
		$updatefields[] = "`{$fieldname}` = '{$value}'";
	}
	$fields = implode(',', $fields);
	$updatefields = implode(',', $updatefields);
	$values = implode(',', $values);
	$query = db_mysql_query("INSERT INTO `{$table}` (" . $fields .') VALUES (' .
		$values . ') ON DUPLICATE KEY UPDATE ' . $updatefields, array(), $debug);
	return db_mysql_success();
}

function db_mysql_select($table, $params = array(), $debug = false) {
	$fieldlist = db_mysql_table_info($table);
	if (!$fieldlist) {
		throw new Exception("missing table definition for table {$table}", 1);
		return array();
	}
	$fieldlist = array_keys($fieldlist);
	$args = array();
	$signs = array('>=', '<=', '!=', '>', '<', '*', '@', ':');
	$opts = array(
		'#order' => '',
		'#key' => '',
		'#limit' => '',
		'#fields' => '',
		'#concat' => '',
	);
	$qfields = '*';
	if (isset($params['#fields'])) {
		$qfields = $params['#fields'];
	}
	$query = "SELECT {$qfields} FROM `{$table}` WHERE 1";
	foreach ($params as $k => $v) {
		if (isset($opts[$k])) {
			$opts[$k] = $v;
			continue;
		}
		$sign = NULL;
		foreach ($signs as $_sign) {
			if ( strstr($k, $_sign) ) {
				$sign = $_sign;
				$k = str_replace($sign, '', $k);
				break;
			}
		}

		if (!$sign) {
			$sign = '=';
		}

		if (!in_array($k, $fieldlist)) {
			throw new Exception("column '{$table}.{$k}' invalid", 1);
			return array();
		}
		if ($sign == '*') {
			$vl = array();
			foreach ($v as $_v) {
				$vl[] = '"' . addslashes($_v) . '"';
			}

			$vl = implode(',', $vl);
			$query .= " AND `$k` IN (" . $vl . ")";
		} else if ($sign == '@') {
			$vl = array();
			foreach ($v as $_k => $_v) {
				$vl[] = $_k .' LIKE "%' . addslashes($_v) . '%"';
			}
			$vl = implode(' OR ', $vl);
			$query .= " AND (" . $vl . ")";
		} else if ($sign == ':') {
			$vl = array();
			foreach ($v as $_k => $_v) {
				$vl[] = $_k .' LIKE "%' . addslashes($_v) . '%"';
			}
			$vl = implode(' OR ', $vl);
			$query .= " OR (" . $vl . ")";
		} else {
			$query .= " AND `$k` {$sign} '" . addslashes($v) . "'";
			$args[] = $v;
		}
	}

	if ($opts['#concat']) {
		$query .= " AND {$opts['#concat']}";
	}

	if ($opts['#order']) {
		$query .= " ORDER BY {$opts['#order']}";
	}

	if ($limit = $opts['#limit']) {
		$query .= " LIMIT {$opts['#limit']}";
	}

	$db_result = db_mysql_query($query, array(), $debug);
	if (!db_mysql_num_rows($db_result))
		 return array();
	$output = array();
	$keyname = ($opts['#key'] ? $opts['#key'] : null);
	while ( $row = db_mysql_fetch($db_result) ) {
		if (!$keyname) {
			@$keyname = array_shift(array_keys($row));
		}
		$output[$row[$keyname]] = $row;
	}
	return $output;
}

function db_mysql_delete($table, $params) {
	$fieldlist = array_keys(db_mysql_table_info($table));
	if (!$fieldlist) {
		return false;
	}
	$query = '';
	$args = array();
	$signs = array('>=', '<=', '!=', '>', '<', '*');
	foreach ($params as $k => $v) {
		$sign = NULL;
		foreach ($signs as $_sign) {
			if ( strstr($k, $_sign) ) {
				$sign = $_sign;
				$k = str_replace($sign, '', $k);
				break;
			}
		}
		if (!$sign) {
			$sign = '=';
		}
		if (!in_array($k, $fieldlist)) {
			return array();
		}
		if ($sign == '*') {
			$vl = array();
			foreach ($v as $_v) {
				$vl[] = '"' . addslashes($_v) . '"';
			}
			$vl = implode(',', $vl);
			$query .= " AND `$k` IN (" . $vl . ")";
		} else {
			$query .= " AND `$k` {$sign} '" . addslashes($v) . "'";
			$args[] = $v;
		}
	}
	if (!$query) {
		// we cannot let this function remove all rows of the table due to an error ...
		return false;
	}
	$query = "DELETE FROM `{$table}` WHERE 1 " . $query;
	db_mysql_query($query);
	return db_mysql_success();
}

function db_redis_init() {
	global $redis, $config;

	if ($redis) {
		return true;
	}
	try {
		$redis = new Redis();
		$redis->connect($config['redis']['server'], $config['redis']['port']);
		$redis->select(intval($config['redis']['db']));
	}
	catch (RedisException $e) {
		die("Redis connection failed");
		return false;
	}
	return true;
}

function db_mongodb_init() {
	global $mongo, $mongodb, $mongo_temporal_stats, $config, $mongo_timebase;

	if ($mongo && $mongodb && $mongo_temporal_stats) {
		return true;
	}
	try {
		$mongo = new Mongo($config['mongo']['server']);
		$mongodb = $mongo->selectDB($config['mongo']['db']);
		$mongo_temporal_stats = $mongodb->createCollection('temporal_stats');
		$mongo_temporal_stats->ensureIndex(array('ts' => 1));
		$mongo_timebase = $mongodb->createCollection('timebase');
		$mongo_timebase->ensureIndex(array('node' => 1, 'type' => 1));
	}
	catch (MongoException $e) {
		die("MongoDB connection failed");
		return false;
	}
	return true;
}

function db_get_current_snapshot($node = '', $type = '') {
	global $mongodb;

	if (!db_mongodb_init()) {
		return array();
	}
	$filter = 'nodes';
	if ($node) {
		$filter .= '.' . $node;
	}
	if ($type) {
		$filter .= '.' . $type;
	}
	$_filter = array($filter => 1);
	$r = $mongodb->hmon->findOne(array('type' => 'snapshot'), $_filter);
	return $r['nodes'];
}

function db_get_temporal_stats($ts, $node = '', $type = '') {
	global $mongo_temporal_stats;

	$ts = intval($ts);
	if (!$ts) {
		return array();
	}
	if (!db_mongodb_init()) {
		return array();
	}
	$ts = new MongoDate($ts);
	$filter = '';
	if ($node) {
		$filter .= $node;
	}
	if ($type) {
		if ($node) {
			$filter .= '.';
		}
		$filter .= $type;
	}
	$_filter = array();
	if ($filter) {
		$_filter[$filter] = 1;
	}
	$r = $mongo_temporal_stats->findOne(array('ts' => $ts), $_filter);
	//$r = $mongo_temporal_stats->findOne(array('ts' => $ts));
	return $r;
}

function db_get_timebase($node, $type) {
	global $mongo_timebase, $mongo_cache;

	if (isset($mongo_cache[$node][$type])) {
		return $mongo_cache[$node][$type];
	}

	$output = array();
	if (!db_mongodb_init()) {
		return $output;
	}
	$r = $mongo_timebase->findOne(array('node' => $node, 'type' => $type));
	if (is_array($r) && isset($r['p'])) {
		$mongo_cache[$node][$type] = $r['p'];
		return $mongo_cache[$node][$type];
	}
	return array();
}

function data_fetch($table, $pkid_value = null, $fields = array()) {
	$may_cache = true;
	if (isset($fields['#nocache'])) {
		$may_cache = false;
		unset($fields['#nocache']);
	}
	if ($pkid_value === null) {
		return db_mysql_select($table, $fields);
	} else {
		// always assumes that the table's primary key is the first column
		// described by db_mysql_table_info()'s map
		@$pkid_field = array_shift(array_keys(db_mysql_table_info($table)));
		if (!$pkid_field) {
			return array();
		}
		if (!is_numeric($pkid_value)) return array();
		$r = db_mysql_select($table, array($pkid_field => $pkid_value));
		return ($r ? array_shift($r) : array());
	}	
}











