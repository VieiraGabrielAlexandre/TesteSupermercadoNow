<?php

function pages_render($name = 'main', $variables = array()) {
	$variables = array_merge(template_get_default_vars(), $variables);
	if (!tools_sane_filename($name)) {
		//return "[invalid template: $_filepath]";
		die("[invalid template: $_filepath]");
	}
	$_filepath = "./pages/page-{$name}.php";	
	if ((!$_filepath) || (!file_exists($_filepath))) {
		die("[missing template: $_filepath]");
	}
	extract($variables, EXTR_SKIP);
	unset($variables);
	ob_start();
	include $_filepath;
	$contents = ob_get_contents();
	ob_end_clean();
	return $contents;
}


function pages_perm_logado() {
	$user = get_logged_user();

	// if(isset($_SESSION['#admin']['uid']))
	// 	return 1;

	return (isset($user['uid']));
}

function pages_login_redirect() {
	header('HTTP/1.0 403 Permission Denied');
	header('Location: /login');
	exit;
}


function pages_email_render($name = 'main', $variables = array()) {
	//$variables = array_merge(template_get_default_vars(), $variables);
	if (!tools_sane_filename($name)) {
		//return "[invalid template: $_filepath]";
		die("[invalid template: $_filepath]");
	}
	$_filepath = "./pages/email-{$name}.php";	
	if ((!$_filepath) || (!file_exists($_filepath))) {
		die("[missing template: $_filepath]");
	}
	extract($variables, EXTR_SKIP);
	unset($variables);
	ob_start();
	include $_filepath;
	$contents = ob_get_contents();
	ob_end_clean();
	return $contents;
}


function page_homepage(){
	// $user = get_logged_user();

	$q = db_mysql_query("SELECT * FROM users limit 10");
	while($r = db_mysql_fetch($q)){
		
	}


	return array('page_title' => 'Home', 'body' => pages_render('home'));
}


function page_login($enviado = false){
	return array('page_title' => 'Login', 'body' => pages_render('login'));
}

function page_reset_password($uid, $token, $enviado = false){
	return array(
		'page_title' => 'Defina sua nova senha',
		'body' => pages_render('defina-senha'),
		'right_sidebar' => false,
	);
}




function get_ajax(){
	// $user = get_logged_user();
	if(isset($_GET['consulta-cep'])){
		$cep = $_POST['cep'];
		$cidade = "";
		$estado = "";
		$endereco = "";
		$geo = get_cep_brasil($cep);
		$cidade = utf8_encode($geo['cidade']);
		$bairro = utf8_encode($geo['bairro']);
		$estado = $geo['uf'];
		$endereco = $geo['endereco'];
		return encode(array('status' => true, 'msg' => '', 'cidade' => $cidade, 'bairro' => $bairro, 'estado' => $estado, 'endereco' => $endereco));		
	}
}

function get_lojas($id = null, $fields = array()) {
	return data_fetch('lojas', $id, $fields);	
}


function encode($e = array()){
	echo json_encode($e);
	exit;
}

function page_logout(){
	$logout = user_logout();
	Header('Location: /login');
	exit;
}
