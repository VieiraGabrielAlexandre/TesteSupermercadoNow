<?php

function stringToColor($str){
  $code = dechex(crc32($str));
  $code = substr($code, 0, 6);
  return $code;
}

function percentToColor($value,$brightness = 255, $max = 100,$min = 0, $thirdColorHex = '00'){       
    $first = (1-($value/$max))*$brightness;
    $second = ($value/$max)*$brightness;

    $diff = abs($first-$second);    
    $influence = ($brightness-$diff)/2;     
    $first = intval($first + $influence);
    $second = intval($second + $influence);

    $firstHex = str_pad(dechex($first),2,0,STR_PAD_LEFT);     
    $secondHex = str_pad(dechex($second),2,0,STR_PAD_LEFT); 

    return $firstHex . $secondHex . $thirdColorHex ; 

    // alterativas
    // return $thirdColorHex . $firstHex . $secondHex; 
    // return $firstHex . $thirdColorHex . $secondHex;
}

function tools_win_to_utf8($str){
	// Geralmente quando vem pelo excel, vem em Windows-1252
    return iconv("Windows-1252", "UTF-8", $str);
}	

function tools_exportar_excel($nome,$tabela){
	header("Content-type: application/vnd.ms-excel");   
	header("Content-type: application/force-download");  
	header("Content-Disposition: attachment; filename=".$nome.".xls");
	header("Pragma: no-cache");
	echo $tabela;
	exit;
}

function tools_array_to_table($data,$args=false) {
  if (!is_array($args)) { $args = array(); }
  foreach (array('class','column_widths','custom_headers','format_functions','nowrap_head','nowrap_body','capitalize_headers','top_info') as $key) {
	if (array_key_exists($key,$args)) { $$key = $args[$key]; } else { $$key = false; }
  }
  if ($class) { $class = ' class="'.$class.'"'; } else { $class = ''; }
  if (!is_array($column_widths)) { $column_widths = array(); }

	if (array_key_exists('headers',$data)) { unset($data['headers']); }

  $t = '<table'.$class.' border="1">';
  $i = 0;
  if($top_info){
  	foreach ($top_info as $info)
  		echo $info."\n";
  }
  foreach ($data as $row) {
	$i++;

	if ($i == 1) { 
	  foreach ($row as $key => $value) {
		if (array_key_exists($key,$column_widths)) { $style = ' style="width:'.$column_widths[$key].'px;"'; } else { $style = ''; }
		$t .= '<col'.$style.' />';
	  }
	  $t .= '<thead><tr>';
	  foreach ($row as $key => $value) {
		if (is_array($custom_headers) && array_key_exists($key,$custom_headers) && ($custom_headers[$key])) { $header = $custom_headers[$key]; }
		elseif ($capitalize_headers) { $header = ucwords($key); }
		else { $header = $key; }
		if ($nowrap_head) { $nowrap = ' nowrap'; } else { $nowrap = ''; }
		$t .= '<td'.$nowrap.'>'.utf8_decode($header).'</td>';
	  }
	  $t .= '</tr></thead>';
	}

	if ($i == 1) { $t .= '<tbody>'; }
	$t .= '<tr>';
	foreach ($row as $key => $value) {
	  if (is_array($format_functions) && array_key_exists($key,$format_functions) && ($format_functions[$key])) {
		$function = $format_functions[$key];
		if (!function_exists(key($function))) { die('Array to Table, function does not exists: '.htmlspecialchars(key($function))); }
		foreach($function[key($function)] as &$v)
			if($v == '%s')
				$v = $value;	
		$value = call_user_func_array(key($function),$function[key($function)]);
		if(key($function)=='date' && $value == '31/12/1969 21:00')
			$value = '';
	  }
	  if ($nowrap_body) { $nowrap = ' nowrap'; } else { $nowrap = ''; }
	  $t .= '<td'.$nowrap.'>'.utf8_decode($value).'</td>';
	}
	$t .= '</tr>';
  }
  $t .= '</tbody>';
  $t .= '</table>';
  return $t;
}

function tools_paginacao($items, $items_pagina, &$pagina_atual, &$pagina_total, &$pagina_anterior, &$pagina_proxima, &$indice_primeiro, &$indice_ultimo, &$items_total) {
	if ((!$items) || (!is_array($items)))
		return array();
	$items_total = sizeof($items);
	$pagina_total = ceil($items_total / $items_pagina);
	if ((!$pagina_atual) || ($pagina_atual < 1) || ($pagina_atual > $pagina_total)) {
		$pagina_atual = 1;
	}
	$pagina_anterior = ($pagina_atual == 1 ? 0 : ($pagina_atual-1));
	$pagina_proxima  = ($pagina_atual == $pagina_total ? 0 : ($pagina_atual+1));
	$indice_primeiro = ((($pagina_atual - 1) * $items_pagina) + 1);
	$indice_ultimo   = (($indice_primeiro + $items_pagina - 1) > $items_total ? $items_total : ($indice_primeiro + $items_pagina - 1));
	return array_slice($items, $indice_primeiro - 1, $items_pagina, TRUE);
}

function tools_render_template($name, $variables = array()) {
	$_filepath = './templates/template.' . $name . '.php';
	if (!file_exists($_filepath))
		return "[missing template: $_filepath]";
	extract($variables, EXTR_SKIP);
	unset($variables);
	ob_start();
	include $_filepath;
	$contents = ob_get_contents();
	ob_end_clean();
	return $contents;
}

function tools_valida_email($email) {
	return preg_match( "/^[\d\w\/+!=#|$?%{^&}*`'~-][\d\w\/\.+!=#|$?%{^&}*`'~-]*@[A-Z0-9][A-Z0-9.-]{1,61}[A-Z0-9]\.[A-Z]{2,6}$/ix", $email );
}

function tools_limpa_numericos($numero) {
	return preg_replace('#([^0-9]*)#', '', $numero);
}

// quebra um telefone tipo '(11) 555-6666' em DDD (11) e fone (555-6666).
function tools_parse_phone($phone) {
	if (preg_match('#(?:\((?P<ddd>[0-9]+)\))? *(?P<phone>[0-9\-]+)#', trim($phone), $regs)) {
		return array('ddd' => $regs['ddd'], 'phone' => $regs['phone']);
	}
	return array('ddd' => '', 'phone' => '');
}

function tools_separador_decimal_br($x) {
	return round($x,0);
	$x = (string) $x;
	if (strpos($x, '.') !== false) {
		$x = str_replace('.', ',', $x);
		if (substr($x, -2, 1) == ',') {
			$x = $x . '0';
		}
	} else {
		$x = $x . ',00';
	}
	return $x;
}
   function formata_pontos($pontos){
      return number_format($pontos,2,',','.');
   }
function _tools_separador_decimal_br($x) {

	$x = (string) $x;
	if (strpos($x, '.') !== false) {
		$x = str_replace('.', ',', $x);
		if (substr($x, -2, 1) == ',') {
			$x = $x . '0';
		}
	} else {
		$x = $x . ',00';
	}
	return $x;
}

function tools_separador_decimal_br_dotted($x) {
	$x = (string) $x;
	if (strpos($x, '.') !== false) {
		if (substr($x, -2, 1) == '.') {
			$x = $x . '0';
		}
	} else {
		$x = $x . '.00';
	}
	return $x;
}

function tools_mascara_cep($cep) {
	$cep = (string) tools_limpa_numericos($cep);
	return substr($cep, 0, 5) . '-' .
		substr($cep, 5, 3);
}

function tools_mascara_cpf($cpf) {
	$cpf = (string) tools_limpa_numericos($cpf);
	return substr($cpf, 0, 3) . '.' .
		substr($cpf, 3, 3) . '.' .
		substr($cpf, 6, 3) . '-' .
		substr($cpf, 9, 2);
}

function tools_mascara_cnpj($cnpj) {
	//__.___.___/____-__
	$cnpj = (string) tools_limpa_numericos($cnpj);
	return substr($cnpj, 0, 2) . '.' .
		substr($cnpj, 2, 3) . '.' .
		substr($cnpj, 5, 3) . '/' .
		substr($cnpj, 8, 4) . '-' .
		substr($cnpj, 12, 2);
}


function tools_valida_cpf($cpf){
	$cpf = str_pad(tools_limpa_numericos($cpf), 11, '0', STR_PAD_LEFT);
	if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
		return false;
	for ($t = 9; $t < 11; $t++) {
		for ($d = 0, $c = 0; $c < $t; $c++) {
			$d += $cpf{$c} * (($t + 1) - $c);
		}
		$d = ((10 * $d) % 11) % 10;
		if ($cpf{$c} != $d) {
			return false;
		}
	}
	return true;
}

function tools_convert_date_from_br($date) {
	// from '3/22/1985' to '1985-03-22'
	$pieces = explode('/', $date);
	return $pieces[2] . '-' .
		sprintf('%02d', $pieces[0]) . '-' .
		sprintf('%02d', $pieces[1]);
}


// Cria uma função que retorna o timestamp de uma data no formato DD/MM/AAAA
function tools_Timestamp($data) {
$partes = explode('/', $data);
return mktime(0, 0, 0, $partes[0], $partes[1], $partes[2]);
}

function convert_charset_latin_utf8($text) {
	//return iconv('ISO-8859-1', 'UTF-8//TRANSLIT', $text);
	return iconv('ISO-8859-1', 'UTF-8', $text);
}

function tools_convert_date_from_us($date) {
	// from '22/3/1985' to '1985-03-22'
	$pieces = explode('/', $date);
	return $pieces[2] . '-' . $pieces[1] . '-' . $pieces[0];
}

function tools_convert_date_from_br2($date) {
	// from '1985-03-22' to '3/22/1985'
	$pieces = explode('-', $date);
	return $pieces[2] . '/' . $pieces[1] . '/' . $pieces[0];
}

function tools_format_date($date, $pais){
	$pieces = explode('-', $date);
	if($pais == "brasil") return sprintf('%02d', $pieces[2]) . '/' . $pieces[1];
	return sprintf('%02d', $pieces[1]) . '/' .  sprintf('%02d', $pieces[2]). '/' .  $pieces[0];
}

function tools_convert_date_pais($date, $pais) {
	$pieces = explode('-', $date);
	if($pais == "brasil") return sprintf('%02d', $pieces[2]) . '/' .  sprintf('%02d', $pieces[1]);
	return sprintf('%02d', $pieces[1]) . '/' .  sprintf('%02d', $pieces[2]). '/' .  substr($pieces[0],2,2);
}


function tools_check_plain($text) {
	return htmlspecialchars($text, ENT_QUOTES);
}

function tools_html_attributes($attributes = array()) {
	if (is_array($attributes)) {
		$t = '';
		foreach ($attributes as $key => $value) {
			$t .= " $key=".'"'. trim(check_plain($value)) .'"';
		}
		return $t;
	}
}

function tools_getmicrotime() {
	return microtime(true);
}

function tools_timer_start() {
	return tools_getmicrotime();
}

function tools_timer_duration($timer) {
	return sprintf('%01.3f', tools_getmicrotime() - $timer);
}

function tools_secs_to_hhmmss($sec, $padHours = false) {
	$hms = "";
	$hours = intval(intval($sec) / 3600);
	$hms .= ($padHours) ? str_pad($hours, 2, "0", STR_PAD_LEFT). ':' : $hours. ':';
	$minutes = intval(($sec / 60) % 60);
	$hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ':';
	$seconds = intval($sec % 60);
	$hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);
	return $hms;
}

function tools_valida_alpha($texto = '', $fixed_size = null) {
	if (!ereg('^([A-Za-z0-9]+)$', $texto)) {
		return false;
	}
	if (is_int($fixed_size) && (strlen($texto) != $fixed_size)) {
		return false;
	}
	return true;
}

function tools_sane_filename($filename = '') {
	return preg_match('#^([A-Za-z0-9\-]+)$#', $filename);
}

function tools_attributes($attributes = array()) {
	if (is_array($attributes) && $attributes) {
		$t = '';
		foreach ($attributes as $key => $value) {
			$t .= " $key=".'"'. $value .'"';
		}
		return $t;
	}
}

function tools_baseurl($absolute = FALSE) {
	$ret = '';
	if ($absolute) {
		$scheme = ( @$_SERVER["HTTPS"] == 'on' ? 'https' : 'http' );
		$ret = $scheme . '://' . $_SERVER['HTTP_HOST'];
	}
	if ($dir = trim(dirname($_SERVER['PHP_SELF']), '\,/')) {
		$ret .= "/$dir";
	};
	return $ret;
}

function tools_url($path = '', $args = array(), $queries = array(), $absolute = FALSE) {
	$q = FALSE;
	$r = tools_baseurl($absolute) . '/' . $path;
	if ($args) {
		foreach ($args as $k => $v) {
			if (substr($r, -1) != '/') {
				$r .= '/';
			}
			$r .= tools_escape_url($k) . ':' . tools_escape_url($v);
		}
	}
	if ($queries) {
		$r .= '?';
		$qlist = array();
		foreach ($queries as $k => $v) {
			$qlist[] = urlencode($k) . '=' . urlencode($v);
		}
		$r .= implode('&', $qlist);
	}
	return $r;
}

function tools_goto($path) {
	$url = tools_url($path, array(), array(), TRUE);
	header("Location: {$url}");
	exit;
}

function tools_link($text, $path = '', $attributes = array(), $queries = array(), $absolute = FALSE) {
	$url = tools_url($path, $queries, $absolute);
	$r = "<a href='{$url}'";
	if ($attributes) {
		$r .= tools_attributes($attributes);
	}
	$r .= ">{$text}</a>";
	return $r;
}

function tools_fetch_urlargs() {
	$r = array();
	if (preg_match_all('%/([^:/]+):([^/&]+)%', $_GET['q'], $results, PREG_PATTERN_ORDER)) {
		foreach ($results[1] as $idx => $key) {
			$r[$key] = $results[2][$idx];
		}
	}
	return $r;
}

function tools_escape_url($url) {
	return str_replace(' ', '-', $url);
}

function tools_unescape_url($url) {
	return str_replace('-', ' ', $url);
}

function tools_json_output($data = array()) {
	print json_encode($data);
	return null;
}

function tools_print_r($data) {
	if (php_sapi_name() != 'cli') {
		print "<PRE>" . print_r($data, true) . "</PRE>";
	} else {
		print_r($data, true);
	}
}

function fatal($msg) {
	die($msg);
}

function tools_convert_decimal($n, $decimals = 2) {
	$r = (float) str_replace(',', '.', $n);
	return number_format($r, $decimals, '.', '');
}
function tools_convert_reais($n, $decimals = 2) {
	return number_format($n, $decimals, ',', '.');
}

function tools_sendmail($from, $to, $subject, $body) {

	// $headers  = 'MIME-Version: 1.0' . "\r\n";
	// $headers .= 'Content-type: text/html; charset="UTF-8"' . "\r\n";
	// $headers .= "To: {$to}" . "\r\n";
	// $headers .= "From: Favorite Shop <{$from}>";
	// return mail($to, $subject, $body, $headers, "-r".$from);

	require_once("static/phpmailer/PHPMailerAutoload.php");

	date_default_timezone_set('Etc/UTC');
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = 0;
	$mail->Debugoutput = 'html';
	$mail->CharSet = 'UTF-8';
	$mail->Host = "smtp.domain.com.br";
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->Username = "name@domain.com.br";
	$mail->Password = "#Mudar123!";
	$mail->setFrom('name@domain.com.br', 'SITE_NAME');
	$mail->addReplyTo('name@domain.com.br', 'SITE_NAME');
	$mail->addAddress('name@domain.com.br');
	$mail->addAddress($to);
	$mail->Subject = $subject;
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	$mail->msgHTML($body);
	$mail->AltBody = 'This is a plain-text message body';
	if (!$mail->send()) {
		return false;
	} else {
		return true;
	}

}

function tools_random_sha1() {
	return sha1(file_get_contents('/dev/urandom', false, null, 0, 256));
}

// funcao usada pra salvar eventos importantes no website que 
// merecem atencao dos administradores
function watchdog($tipo, $titulo, $desc = null, $dados = array()) {
	global $profiling;

	$user = get_logged_user();
	db_mysql_save('watchdog', array(
		'req_timestamp' => (string) isset($profiling['req_start']) ? $profiling['req_start'] : gettimeofday(true),
		'timestamp' => (string) gettimeofday(true),
		'uid' => (isset($user['uid']) ? $user['uid'] : 0),
		'console' => (php_sapi_name() == 'cli' ? 1 : 0),
		'tipo' => $tipo,
		'titulo' => $titulo,
		'desc' => ($desc ? $desc : ''),
		'dados' => ($dados ? json_encode($dados, JSON_FORCE_OBJECT) : '{}'),
	));
}

function console_output($data) {
	return '[' . date('r') . '] ' . $data . "\n";
}

function console_loginit() {
	global $config, $console_logfp;

	$logfile = getenv('LOGFILE');
	if (!$logfile) {
		if (isset($config['console_logfile'])) {
			$logfile = $config['console_logfile'];
		}
	}
	if ($logfile && (!$console_logfp)) {
		$console_logfp = fopen($logfile, 'w+');
		if (!$console_logfp) {
			console_log("WARNING: failed to open logfile: {$logfile}");
		} else {
			console_log("logging to file: {$logfile}");
		}
	}	
}

function console_log($data) {
	global $console_logfp;

	if (php_sapi_name() != 'cli') return;
	$output = console_output($data);
	if ($console_logfp) {
		if (flock($console_logfp, LOCK_EX)) {
			fwrite($console_logfp, $output);
			fflush($console_logfp);
			flock($console_logfp, LOCK_UN);
		}
	}
	fwrite(STDOUT, $output);
	fflush(STDOUT);
	return true;
}


function _p($p){
	echo "<pre>";
	print_r($p);
	echo "<pre>";
}

function media_site_basepath($sid){
	$filename = substr(md5($sid), 0, 6);
	return  substr($filename, 0, 3) . "/" . substr($filename, 3, 3) . "/" . $sid;
}

function media_basepath($filename, $site = array()) {
	global $config;
	return  $config['media_baseurl'] . "/" . $site['media_path'] . "/" . $filename;
}


function media_filepath($filename, $site = array()) {
	global $config;
	return  $config['media_basepath'] . "/" . $site['media_path'] . "/" . $filename;
}

// confs traducao 
$translater_language = array(
 'en' => 'en_US',
 'pt' => 'pt_BR',
 'es' => 'es_ES',
);

function get_nivel(){
	return array(
		'' => 'Selecione',
		'admin' => 'Adminstrador',
		'proprietario' => 'Proprietário',
		'fornecedor' => 'Fornecedor',
		'consultor' => 'Consultor',
	);	
}


// todos os itens que pode ter em uma casa
$itens_casa = array(
   1 => array(
    'titulo' => 'Pool/Spa',
    'itens' => array(
     'extra_pool' => 'Communal Pool',
     'extra_private_pool' => 'Private Pool',
     'extra_spa' => 'Spa',
     'extra_out_tub' => 'Outdoor Hot-tub',
     'extra_ind_tub' => 'Indoor Hot-tub',
     'extra_solar_heat' => 'Free Solar Heat',
     'extra_pool_heatable' => 'Private Pool Heatable',
     'extra_facing_pool' => 'South Facing Pool',
     'extra_pool_access' => 'Pool Access',
     'extra_ind_jacuzzi' => 'Indoor Jacuzzi',
    ),
   ),

   array(
    'titulo' => 'General facilites',
    'itens' => array(
     'extra_bbq' => 'BBQ',
      'extra_grell' => 'Grill',
      'extra_hair_dryer' => 'Hair Dryer (s)',
      'extra_dishwasher' => 'Dishwasher',
      'extra_mini_kitchen' => 'Mini Kitchen',
      'extra_full_kitchen' => 'Full Kitchen',
      'extra_resort_amen' => 'Resort Amenities',
      'extra_elevator' => 'Elevator',
      'extra_whel_chair_acc' => 'Wheel Chair Accessible',
      'extra_free_calls' => 'Free Calls',
      'extra_pav_park' => 'Paved Parking',
      'extra_rock_chairs' => 'Rocking Chairs',
      'extra_microwave' => 'Microwave',
      'extra_laundry_in' => 'Laundry in Unit',
      'extra_laundry_on' => 'Laundry on-site',
      'extra_unit_amen' => 'Unit Amenities',
      'extra_dock' => 'Dock',
      'extra_motor_cyde,' => 'Motor Cyde',
    ),
   ),

   array(
    'titulo' => 'Internet',
    'itens' => array(
      'extra_wifi' => 'wifi',
      'extra_wired_internet' => 'Wired Internet Access',
      'extra_internet_pc' => 'Internet PC/device included',
    ),
   ),

   array(
    'titulo' => 'Child Features',
    'itens' => array(
      'extra_stroller' => 'Stroller/Pushchair',
      'extra_crib' => 'Crib/Cot',
      'extra_packnplay' => 'Pack n Play',
      'extra_high_chair' => 'High Chair',
    ),
   ),

   array(
    'titulo' => 'Heating/Cooling',
    'itens' => array(
      'extra_eletric_fireplace' => 'Eletric Fireplace',
      'extra_wood_burning' => 'Wood Burning Fireplace',
      'extra_under_floor_heat' => 'Under Floor Heating',
      'extra_gas_fireplace' => 'Gas Fireplace',
      'extra_airconditioning' => 'Air Conditioning',
    ),
   ),

   array(
    'titulo' => 'General facilites',
    'itens' => array(
      'extra_games_room' => 'Games room',
      'extra_communal_gym' => 'Communal  Gym',
      'extra_air_hockey' => 'Air Hockey Table',
      'extra_foosball' => 'Foosball table',
      'extra_pool_table' => 'Pool table',
      'extra_video_games' => 'Video games',
      'extra_vcr' => 'VCR',
      'extra_table_tennis' => 'Table tennis',
      'extra_golf_incl' => 'Golf included',
      'extra_big_scr_tv' => 'Big screen tv',
      'extra_tv_bedrooms' => 'tv in every bedroom',
      'extra_cdplayer' => 'CD player',
      'extra_dvd_blueray' => 'DVD/Blue Ray player',
      'extra_fishing' => 'Fishing',
      'extra_club_house' => 'Club house',
      'extra_tennis_court' => 'Tennis courts',
    ),
   ),

   array(
    'titulo' => 'Segurança',
    'itens' => array(
     'extra_camera' => 'Camera',
     'extra_alarme' => 'Alarme',
    ),
   ),

   array(
    'titulo' => 'Other Features',
    'itens' => array(
      'extra_pets' => 'Pets allowed',
      'extra_gas_free' => 'Gas free?',
      'extra_privacy_fence' => 'Privacy fence',
      'extra_beach_on' => 'Beach on site',
    ),
   ),
);



// // todos os itens que pode ter em uma casa
// $itens_casa = array(
// 	1 => array(
// 		'titulo' => 'Características',
// 		'itens' => array(
// 			'extra_piscina' => 'Piscina',
// 			'extra_wifi' 	=>'Wifi',
// 			'extra_churrasqueira' => 'Churrasqueira',
// 			'extra_ar' 	=> 'Ar condicionado',
// 			'extra_tv' 	=> 'TV',
// 			'extra_banheira' => 'Banheira',
// 			'extra_ventilador' => 'Ventilador',
// 		),
// 	),
// 	2 => array(
// 		'titulo' => 'Segurança',
// 		'itens' => array(
// 			'extra_camera' => 'Camera',
// 			'extra_alarme' => 'Alarme',
// 		),
// 	),
// );

$itens_cama = array(
	'king' => 2,
	'queen' => 2,
	'full' => 2,
	'solteiro' => 1,
	'beliche' => 2,
	'bicama' => 2,
);

$meses = array(
	1=>'Janeiro',
	2=>'Fevereiro',
	3=>'Março',
	4=>'Abril',
	5=>'Maio',
	6=>'Junho',
	7=>'Julho',
	8=>'Agosto',
	9=>'Setembro',
	10=>'Outubro',
	11=>'Novembro',
	12=>'Dezembro'
);


$estados = array(
	'Califórnia',
	'Texas	',
	'Nova Iorque',
	'Flórida',
	'Illinois',
	'Pensilvânia',
	'Ohio	',
	'Michigan',
	'Geórgia	',
	'Carolina do Norte',
	'Nova Jérsei',
	'Virgínia',
	'Washington',
	'Massachusetts',
	'Indiana',
	'Arizona',
	'Tennessee',
	'Missouri',
	'Maryland',
	'Wisconsin',
	'Minnesota',
	'Colorado',
	'Alabama',
	'Carolina do Sul',
	'Luisiana',
	'Kentucky',
	'Oregon',
	'Oklahoma',
	'Connecticut',
	'Iowa',
	'Mississippi',
	'Arkansas',
	'Kansas',
	'Utah',
	'Nevada',
	'Novo México',
	'Virgínia Ocidental	1 852 994',
	'Nebraska',
	'Idaho',
	'Havaí',
	'Maine',
	'Nova Hampshire',
	'Rhode Island',
	'Montana',
	'Delaware',
	'Dakota do Sul',
	'Alasca',
	'Dakota do Norte',
	'Vermont',
	'Distrito de Colúmbia',
	'Wyoming'
);

$cidades = array(
	'Flórida' => array(
		'Orlando',
		'Tampa',
		'Kissimmee'

	),
);

$casa_tipos = array(
	'Apartment',
	'House',
	'Office',
	'Resort Home',
	'Studio',
	'Townhouse',
	'Unspecified',
);

$casa_mobiliado = array(
	'Commercial',
	'Furnished',
	'Long term?',
);


function tools_show_dinheiro($moeda, $valor){
	$valor = $valor/100;
	if($moeda == "brasil")
		return "R$ " .number_format($valor,2,',','.');

	return "U$ ". number_format($valor,2,'.',',');
}


function tools_lat_log($endereco, $cidade){

        $url = 'http://maps.google.com/maps/api/geocode/json?address='. $endereco .','. $cidade .'&sensor=false';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset=utf-8', 'SOAPAction: "'. IS2B_URL_SOAP .'"'));
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $geocode = curl_exec($ch);
        $error = curl_error($ch);
        $errno = curl_errno($ch);
        curl_close($ch);
        $output= json_decode($geocode);
        $lat = $output->results[0]->geometry->location->lat;
        $long = $output->results[0]->geometry->location->lng;	

        return array('lat' => $lat, 'long' => $long);

}

function curl_envia_arquivo($url, $arquivo, $nome){
    // somente é aceito pdf, png, jpeg, jpg e mp4

    set_time_limit(0);

    $mime = mime_content_type($arquivo);

    if(!$mime || (!strstr($mime, "video/") && !strstr($mime, "image/") && !strstr($mime, "/pdf") && !strstr($mime, "text/plain") && !strstr($mime, "text/html")))
        return false;

    $cfile = curl_file_create($arquivo,$mime,$nome);
    // $cfile = new CURLFile($arquivo,$mime,'arquivo');

    // Assign POST data
    $imgdata = array('arquivo' => $cfile);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url.'?c4T1ty4Rt4641tY6ge2v41Ib462G54wu6750n651oM0I6851i0ve6Y15');
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $imgdata);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);

    $r = curl_exec($curl); 
    $erro = curl_error($curl);

    curl_close($curl);

    if($r){
        $json = json_decode($r,1);
        if(is_array($json))
            return $json;
    }
    return false;
}