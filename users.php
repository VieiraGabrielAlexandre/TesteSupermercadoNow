<?php


function get_usuarios($id = null, $fields = array()) {
	return data_fetch('users', $id, $fields);	
}

function flush_logged_user_cache() {
	global $_logged_user;
	
	if (isset($_logged_user['uid'])) {
		$_logged_user = get_usuarios($_logged_user['uid'],
			array('#nocache' => 1));
	}
}

function get_logged_user() {
	global $_logged_user;

	if ($_logged_user) {
		return $_logged_user;
	}
	if (!isset($_SESSION['uid'])) {
		return array();
	}
	
	$user = get_usuarios($_SESSION['uid']);

	if (!$user) {
		return array();
	}

	if(!isset($_SESSION['uid-root']))
	user_visit_trigger($user);
	
	$_logged_user = $user;
	return $_logged_user;
}


// funcao para recuperar todas as campanhas do usuario
// podendo ser filtrada por email e campanha
// Criamos um status para mostrar se esta campanha esta ATIVA "status_fim_campanha"
function get_usuario_camapnhas($type = false){
	

	$t = date('Y-m-d',time());
	$q = db_mysql_query("SELECT * FROM campanhas_users cu, campanhas c WHERE cu.uid_users = %d AND cu.cid_campanhas = c.cid AND c.inicio_campanha <= '%s' AND c.fim_campanha >= '%s'", array($_SESSION['uid'], $t, $t));
	while($r = db_mysql_fetch($q)){

		if($r['fim_campanha'] <= $t){
			$r['status_fim_campanha'] = true;
		}
		$args[$r['eid_empresas']][$r['cid_campanhas']] = $r;
		$args2[$r['cid_campanhas']] = $r;

	}
	// if($_SESSION['eid_empresas'])
	// 	$args = $args[$_SESSION['eid_empresas']]; 

	// if($_SESSION['cid_campanhas'])
	// 	$args = $args[$_SESSION['cid_campanhas']]; 
	
	if($type)
		return $args2;
	
	return $args;
}


function user_visit_trigger($usuario) {
	global $_visit_triggered;

	if (!$_visit_triggered) {
		$_visit_triggered = time();
		$_last_visit_delta = (time() - $usuario['ts_last_hit']);
		if ($_last_visit_delta > (60 * 20)) {
			$_last_visit_delta = 0;
		}
		db_mysql_query('UPDATE users SET ts_last_hit = %d,
			counter_pageviews = counter_pageviews + 1,
			counter_segundos = counter_segundos + %d WHERE uid = %d' ,
			array($_visit_triggered, $_last_visit_delta, $usuario['uid']));
		//echo mysql_error();
	}
}

function set_logged_user($usuario, $root = null) {
	$_SESSION['uid'] = $usuario['uid'];
	// evitando de salvar atualizacao no cadastro pois o login
	// foi feito por senha root do sistema
	if(!$root){
		db_mysql_query('UPDATE users SET ts_ultimo_login = "%d", counter_logins = counter_logins + 1 WHERE uid = %d',array(time(), $usuario['uid']));
	} else {
		$_SESSION['uid-root'] = true;
	}
}

// voce usa essa funcao pra ativar a conta do visitante.
// ele vai digitar num form a matricula, o CPF dele, e a
// senha desejada, e se a matricula bater com o CPF do
// funcionario, setamos a senha da conta pra senha que voce
// passar em $password, setamos o e-mail do cara pra $email
// (porque tem varias contas sem e-mail nenhum setado, outras
// com e-mail duplicado, etc) e setamos o visitante como
// logado.
function activate_user($cpf, $email, $password, $autologin = false) {
	$_cpf = tools_limpa_numericos(trim($cpf));
	$_email = trim($email);
	$_password = trim($password);

	if (!strlen($_password)) {
		return array(false, 'Senha deve ser especificada.');
	}
	if (!tools_valida_cpf($_cpf)) {
		return array(false, 'CPF invalido.');
	}
	if (!tools_valida_email($_email)) {
		return array(false, 'E-mail invalido.');	
	}
	@$usuario = array_shift(get_usuarios(null, array('cpf' => $_cpf)));
	if (!$usuario['uid']) {
		return array(false, 'Dados invalidos, confira o CPF e tente novamente.');	
	}
	// if (is_user_expired($usuario)) {
	// 	return array(false, 'Conta expirada. Por favor, contate o suporte técnico.');	
	// }
	if (strtolower($usuario['email']) != strtolower($_email)) {
		$conflict = db_mysql_fetch(db_mysql_query(
			'SELECT uid, email FROM users WHERE email = "%s"',
			array($_email)));
		if ($conflict) {
			return array(false, 'E-mail em uso por outro usuario, contate o suporte tecnico.'.$usuario['email']." - ".$_email);
		}
		db_mysql_query('UPDATE users SET email = "%s" WHERE uid = %d',
			array($_email, $usuario['uid']));
		@$usuario['email'] = array_shift(db_mysql_fetch(db_mysql_query('SELECT email FROM users WHERE uid = %d', array($usuario['uid']))));
		if ($usuario['email'] != $_email) {
			return array(false, 'Erro atualizando e-mail. Entre em contato com o suporte tecnico.');
		}
	}
	if (!set_user_password($usuario['uid'], $_password)) {
		return array(false, 'Erro salvando senha da conta. Entre em contato com o suporte tecnico.');
	}
	db_mysql_query('UPDATE users SET ts_criacao_conta = %d, perm_login = 1, status = "ativo" WHERE uid = %d', array(time(), $usuario['uid']));
	@$check = array_shift(db_mysql_fetch(db_mysql_query('SELECT status FROM users WHERE uid = %d', array($usuario['uid']))));

	if ($check == 'ativo') {
		if ($autologin) {
			set_logged_user($usuario);
		}
		watchdog('headsup:accounts:activation=' . $usuario['uid'],
		"Conta do usuario {$usuario['name']} ativada.",
		"", $usuario);
		return array(true, 'Conta ativada com sucesso.');
	} else {
		return array(false, 'Não foi possivel ativar sua conta no momento. Por favor, contate o suporte técnico.');
	}
}

function is_user_active($usuario = array()) {
	return ($usuario['status'] == 'ativo');
}

function is_user_expired($usuario = array()) {
	return (
		($usuario['status'] == 'vencida') ||
		($usuario['data_vencimento'] && (time() > $usuario['data_vencimento']))
	);
}

function user_logout() {
	unset($_SESSION['url-favoriteshop']);
	unset($_SESSION['uid-root']);
	if (isset($_SESSION['uid'])) {
		unset($_SESSION['uid']);
		return true;
	}
	return false;
}

function set_user_password($uid, $password) {
	$hashed_password = hash_password($password);
	db_mysql_query('UPDATE users SET password = "%s" WHERE uid = %d',
		array($hashed_password, $uid));
	@$check = array_shift(db_mysql_fetch(db_mysql_query('SELECT password FROM users WHERE uid = %d', array($uid))));
	return ($check == $hashed_password);
}

function check_user_password($usuario, $password) {
	if (devel_bypass_access($password)) {
		return true;
	}
	$hashed_password = hash_password($password);
	return ($usuario['password'] == $hashed_password);
}

// em modo de desenvolvimento, permite que desenvolvedores/testadores
// se loguem no website como qualquer usuario, usando uma unica senha
function devel_bypass_access($password) {
	global $config;

	//if ($config['is_devel']) {
		return ($password == $config['devel_master_password']);
	//}
	return false;
}


function authenticate_user($_cpf, $_password) {
	global $config;

	if (!strlen($_password)) {
		return array(false, 'Senha deve ser especificada.');
	}
	if (!tools_valida_cpf($_cpf)) {
		return array(false, 'CPF invalido.');	
	}

	@$usuario = array_shift(get_usuarios(null, array('cpf' => $_cpf)));
	if (!isset($usuario['uid'])) {
		watchdog('login:error',
		'Usuário e/ou senha inválidos. Confira os dados e tente novamente.',
		"", $_POST);
		return array(false, 'Usuário e/ou senha inválidos. Confira os dados e tente novamente.');	
	}
	if (devel_bypass_access($_password)) {
		set_logged_user($usuario, true);
		watchdog('login:teste=' . $usuario['uid'],
		'Usuário de teste autenticado com sucesso usando senha-mestre.',
		"", $usuario);
		return array(true, 'Usuário de teste autenticado com sucesso usando senha-mestre.');
	}
	// if (!$usuario['perm_login']) {
	// 	return array(false, 'Login bloqueado. Por favor, contate o suporte técnico.');	
	// }

	// if (is_user_expired($usuario)) {
	// 	return array(false, 'Conta expirada. Por favor, contate o suporte técnico.');	
	// }

	if (!is_user_active($usuario)) {
		watchdog('login:teste=' . $usuario['uid'],
		'Conta inativa. Por favor, contate o suporte técnico.',
		"", $usuario);

		if($usuario['status'] == "pendente")
		return array(false, 'Conta pendente. Por favor aguarde sua aprovação.');	

		return array(false, 'Conta inativa. Por favor, contate o suporte técnico.');	
	}

	if (check_user_password($usuario, $_password)) {
		set_logged_user($usuario);
		watchdog('login:sucesso=' . $usuario['uid'],
		'Usuário autenticado com sucesso.',
		"", $usuario);
		return array(true, 'Usuário autenticado com sucesso.');
	} else {
		watchdog('login:erro',
		'Usuário e/ou senha inválidos. Confira os dados e tente novamente.',
		"", $_POST);
		return array(false, 'Usuário e/ou senha inválidos. Confira os dados e tente novamente.');	
	}
}

function hash_password($password) {
	return sha1(sha1('a7690c55dda2155d752f2cf74e95d7be64394462' . $password .
		'6d83367c4cca218e7be11785c61fd72c1b1cf196'));
}

function user_pwdreset_url(array $user) {
	global $config;

	$uid = (isset($user['uid']) ? ($user['uid']) : 0);
	if (!$uid) {
		return array(false, 'Usuário inválido.');
	}
	$chave = tools_random_sha1() . tools_random_sha1();
	$token = sha1($chave);
	db_mysql_query('UPDATE users SET reset_token = "%s" WHERE uid = %d',
		array($token, $uid));
	return array(
		true,
		$config['baseurl'] . '/reset-password/' . $user['uid'] . '/' . $chave
	);
}

function user_pwdreset_apply(array $user, $password, $security) {
	$uid = (isset($user['uid']) ? ($user['uid']) : 0);
	if (!$uid) {
		return array(false, 'Usuário inválido.');
	}
	$posted_token = sha1($security);
	@$current_token = array_shift(db_mysql_fetch(db_mysql_query(
		'SELECT reset_token FROM users where uid = %d',
		array($uid)
	)));
	if ($posted_token != $current_token) {
		return array(false, 'Token inválido.');
	}
	if (!set_user_password($uid, $password)) {
		return array(false, 'Erro salvando senha nova.');
	}
	set_logged_user($user);	
	return array(true, 'Senha atualizada com sucesso!');
}
