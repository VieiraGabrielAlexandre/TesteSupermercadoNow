<?php
	$app_basedir = dirname(__FILE__);
	
	function thumbnail_sizes() {
	return array(1920, 630, 234, 200);
	// return array(1920);
}

function uploads_filepath($filename) {
	return '/media/' . substr($filename, 0, 3) . '/' . substr($filename, 3, 3) . '/' . $filename;
}

// tamanho pode ser 164 ou 287
function uploads_filepath_thumbnail($filename, $tamanho = 164) {
	return "/media/{$tamanho}x{$tamanho}/" . substr($filename, 0, 3) . '/' . substr($filename, 3, 3) . '/' . $filename;

	if (!in_array($tamanho, thumbnail_sizes())) die("tamanho de thumbnail invalido.");
	return "/media/{$tamanho}x{$tamanho}/" . substr($filename, 0, 3) . '/' . substr($filename, 3, 3) . '/' . $filename;
}

function upload_fotos($upload, $type) {
	global $app_basedir;
	$params = array();
//	$current_user = get_logged_user();
	if (isset($upload)) {
		/*
		print "<PRE>" . print_r($_FILES, true) . "</PRE>"; exit;
		$_FILES:
		Array
		(
		    [file] => Array
		        (
		            [name] => dolphin.jpg
		            [type] => image/jpeg
		            [tmp_name] => /tmp/phpFi9OoB
		            [error] => 0
		            [size] => 74919
		        )

		)
		*/
	
		if ($upload['size'] == 0 || $upload['error'] == 1) {
			return tema_alertas(array('status' => 0, 'msg' =>$error = "Imagem vazia."));
			//watchdog("foto={$upload['name']}&acao=save&erro=1&type=empty&uid=".$current_user['uid'], $error, $upload);
			// header('Location: /enviar-fotos');
			exit;
		}

		if (isset($upload['error']) && !$upload['error']) {
			// $fotos_ativas = intval(array_shift(db_fetch_array(db_query('SELECT COUNT(1) FROM fotos WHERE uid_users = %d AND status = "ativo"', array($current_user['uid'])))));
			// if ($fotos_ativas >= 3) {
			// 	tema_alertas($error = "Você já atingiu o número máximo de fotos!");
			// 	watchdog("foto={$upload['name']}&acao=save&erro=1&type=maxlimit&uid=".$current_user['uid'], $error, $upload);
			// 	header('Location: /enviar-fotos');
			// 	exit;
			// }

			$size = $upload['size'];
			if ($size > (1024 * 1024 * 15)) {
				return tema_alertas(array('status' => 0, 'msg' => $error = "Imagem é muito grande: escolha um arquivo menor que 15MB."));
				//watchdog("foto={$upload['name']}&acao=save&erro=1&type=toolarge&uid=".$current_user['uid'], $error, $upload);
				//header('Location: /enviar-fotos');
				exit;
			}

			if ($size == 0) {
				return tema_alertas(array('status' => 0, 'msg' =>$error = "Imagem vazia."));
				//watchdog("foto={$upload['name']}&acao=save&erro=1&type=empty&uid=".$current_user['uid'], $error, $upload);
				// header('Location: /enviar-fotos');
				exit;
			}

			if (!is_uploaded_file($upload['tmp_name'])) {
				return tema_alertas(array('status' => 0, 'msg' =>$error = "Arquivo não é seguro para ser salvo."));
				//watchdog("foto={$upload['name']}&acao=save&erro=1&type=unsafe&uid=".$current_user['uid'], $error, $upload);
				// header('Location: /enviar-fotos');
				exit;
			}

			$allowedTypes = array('png' => '.png', 'jpg' => '.jpg', 'jpeg' => '.jpeg', 'gif' => '.gif', 'zip' => '.zip', 'rar' => '.rar');
			//$detectedType = exif_imagetype($upload['tmp_name']);
			$detectedType = strtolower(pathinfo($upload['name'], PATHINFO_EXTENSION));
			if (!isset($allowedTypes[$detectedType])) {
				return tema_alertas(array('status' => 0, 'msg' =>$error = "Arquivo enviado não possui um formato de imagem válido."));
				//watchdog("foto={$upload['name']}&acao=save&erro=1&type=wrongtype&uid=".$current_user['uid'], $error, $upload);
				// header('Location: /enviar-fotos');
				exit;
			}

			$filename = sha1_file($upload['tmp_name']) . '-' . $current_user['uid'] . $allowedTypes[$detectedType];
			// _p($filename);
			// _p($app_basedir);
			$filepath = $app_basedir . uploads_filepath($filename);
			$image_basedir = dirname($filepath);
			$watchdog_metadata = array(
				'upload_info' => $upload,
				'filepath' => $filepath,
			);
			if (!is_dir($image_basedir)) {
				$oldumask = umask(0);
				@mkdir($image_basedir, 0755, true);
				umask($oldumask);
				if (!is_dir($image_basedir)) {
					return tema_alertas(array('status' => 0, 'msg' =>"Erro salvando imagem, tente novamente mais tarde."));
					//watchdog("foto={$filename}&acao=save&erro=1&type=mkdir&uid=".$current_user['uid'], "Erro criando diretorio: $image_basedir", $watchdog_metadata);
					// header('Location: /enviar-fotos');
					exit;
				}
			}

			if (!move_uploaded_file($upload['tmp_name'], $filepath)) {
				return tema_alertas(array('status' => 0, 'msg' =>"Erro salvando imagem, tente novamente mais tarde."));
				//watchdog("foto={$filename}&acao=save&erro=1&type=move&uid=".$current_user['uid'], "Erro movendo arquivo uploaded.", $watchdog_metadata);
				// header('Location: /enviar-fotos');
				exit;
			}


			$metadata_foto = array(
				'date' => time(),
				'uid_users' => $current_user['uid'],
				'name_users' => $current_user['name'],
				'ip' => implode(',', array_filter(array($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_X_REAL_IP'], $_SERVER['HTTP_X_FORWARDED_FOR']))),
				'imagem' => uploads_filepath($filename),
				'status' => 'ativo',
				'type' => $type,
			);
			return $metadata_foto;
			exit;

		}
	}
}

function tema_alertas($args){
	return $args;
}

function generate_thumbs(){
	print "<PRE>";
	$q = db_query('SELECT imagem FROM fotos');
	while ($foto = db_fetch_array($q)) {
		list($status, $error) = uploads_generate_thumbnails($foto['imagem']);
		if ($status) {
			print "{$foto['imagem']} => OK\n";
		} else {
			print "{$foto['imagem']} => $error\n";
		}
	}
	print "</PRE>";
	exit;
}
