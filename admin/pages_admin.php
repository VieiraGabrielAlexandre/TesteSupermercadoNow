<?php

function page_admin_usuarios_admin($id = null){
	global $config;

	$grid['name'] = "Usuários admin";
	$grid['titles'] = array('Nome', 'E-mail', 'Tipo');
	$grid['config'] = array(
		'show-search' => true,
		'show-pagination' => false,
		'pagination-default' => 50,
		'show-search-get' => false,
		'order-colum' => 0,
		'order-by' => 'ASC'
    );
    
    $grid['buttons-head'] = array(
        array(
            'title' => 'Novo', 
            'command' => '', 
            'icon' => 'icon-plus-circle2 text-primary', 
            'url' => 'listar/novo'
        ),
    );

	//REMOVER ITENS
	if(isset($_GET['type']) && isset($_GET['id']) && $_GET['id'] && $_GET['type'] == 'remover'){
		if(db_mysql_query("DELETE FROM %s WHERE %s = %s", array('admin_users', 'uid', $_GET['id']))){
			Header("Location: ?". $info['url_page_base']."&alerta-sucesso=Usuário removido com sucesso.");
			exit;
		}else{
			$log = db_mysql_fetch(db_mysql_query("SELECT * FROM %s WHERE %s = %s", array('admin_users', 'uid', $_GET['id'])));
			Header("Location: ?". $info['url_page_base']."alerta-erro");
			exit;
		}
	}

	//REMOVER ITENS
	if(isset($_GET['type']) && isset($_GET['id']) && $_GET['id'] && $_GET['type'] == 'unlock'){
		if(db_mysql_query("UPDATE %s SET ts_ultimo_login = null WHERE %s = %s", array('admin_users', 'uid', $_GET['id']))){
			Header("Location: ?". $info['url_page_base']."&alerta-sucesso=Usuário desbloqueado com sucesso.");
			exit;
		}else{
			$log = db_mysql_fetch(db_mysql_query("SELECT * FROM %s WHERE %s = %s", array('admin_users', 'uid', $_GET['id'])));
			Header("Location: ?". $info['url_page_base']."alerta-erro");
			exit;
		}
	}

	if(isset($_POST) && COUNT($_POST)){
		$save['nome'] = $_POST['nome'];
		$save['email'] = $_POST['email'];
		if($_SESSION['#admin']['tipo'] == '1')
			$save['tipo'] = $_POST['tipo'];
		if($_POST['senha'])
			$save['pwd'] = sha1($_POST['senha']);

		if($id&&$id!='novo')
			$save['uid'] = $id;

		if(db_mysql_save('admin_users', $save)){
			$_id = $id&&$id!='novo'?$id:db_mysql_last_insert_id();
			$_tipo = $id&&$id!='novo'?'UPDATE':'INSERT';
			$log = db_mysql_fetch(db_mysql_query("SELECT * FROM %s WHERE %s = %s", array('admin_users', 'uid', $_id)));
			return encode(array('status' => true, 'msg'=>'Dados salvos com sucesso.', 'url'=> './' ));
		} else {
			return encode(array('status' => false, 'msg'=>'Não foi possível salvar os dados.'));
		}

		exit;
	}

	$lista = db_mysql_query("SELECT * FROM admin_users");
	while($v = db_mysql_fetch($lista)){
		$key = $v['uid'];

		if($id && $id == $key){
			$edit = $v;
			unset($edit['pwd']);
			break;
		}

		$grid['items'][$key] = array(
			($v['nome']),
			$v['email'],
			($v['tipo']=='1'?'Admin':'Ponto Focal'),
			'buttonsGrid' => array(
				array('title' => 'Editar', 'command'=> '', 'icon' => 'icon-pencil7', 'url' => $config['baseurl_admin'].'/usuarios/listar/'.$key),
				array('title' => 'Remover', 'command'=> 'class="text-danger-600"', 'icon' => 'icon-trash', 'url' => '?type=remover&id='.$key),
			)
		);
		if($_SESSION['#admin']['tipo'] == '1'){
			$grid['items'][$key]['buttonsGrid'][] = array('title' => 'Liberar login', 'icon' => ' icon-unlocked', 'url' => '?type=unlock&id='.$key);
		}
	}
	unset($grid['items'][1]);

	if((!$id || ($id && $id != $_SESSION['#admin']['uid']))&&$_SESSION['#admin']['tipo'] != '1'){
		header("Location:".$config['baseurl_admin'].'/listar/'.$_SESSION['#admin']['uid']);exit;
	}

	$form = array(
		'id' => '',
		'titulo' => "Cadastro usuário admin",
		'descricao' => "",
	);
	$form['campos'][] = array('titulo' => 'Nome', 'id' => 'nome', 'tipo' => 'text', 'required' => true, 'command' => '', 'placeholder' => '', 'class' => '');
	$form['campos'][] = array('titulo' => 'E-mail', 'id' => 'email', 'tipo' => 'text', 'required' => true, 'command' => '', 'placeholder' => '', 'class' => '');
	if($id && $id=='novo'){
		$form['campos'][] = array('titulo' => 'Senha', 'id' => 'senha', 'tipo' => 'text', 'required' => true, 'command' => '', 'placeholder' => '', 'class' => '');
		if($_SESSION['#admin']['tipo'] != '2')
			$form['campos'][] = array('titulo' => 'tipo', 'id' => 'tipo', 'tipo' => 'select', 'required' => true, 'command' => '', 'placeholder' => '', 'class' => '', 'values'=>array(1=>'Admin',2=>'Analista'));
		$form['campos'][] = array('titulo' => 'Salvar','id' => 'salvar', 'tipo' => 'botao', 'class' => 'text-right', 'icone' => 'icon-arrow-right14 position-right' );
		return array('page_title' => 'Cadastro', 'body' => pages_render('formulario', array('form'=>$form, 'edit' => $edit)));
	}else if($id){
		$form['campos'][] = array('titulo' => 'Nova senha', 'id' => 'senha', 'tipo' => 'text', 'required' => false, 'command' => '', 'placeholder' => 'Não preencha para manter a senha atual.', 'class' => '');
		if($_SESSION['#admin']['tipo'] != '2')
			$form['campos'][] = array('titulo' => 'tipo', 'id' => 'tipo', 'tipo' => 'select', 'required' => true, 'command' => '', 'placeholder' => '', 'class' => '', 'values'=>array(1=>'Admin',2=>'Analista'));
		$form['campos'][] = array('titulo' => 'Salvar','id' => 'salvar', 'tipo' => 'botao', 'class' => 'text-right', 'icone' => 'icon-arrow-right14 position-right' );
		return array('page_title' => 'Cadastro', 'body' => pages_render('formulario', array('form'=>$form, 'edit' => $edit)));
	}
	return array('page_title' => 'Usuários admin', 'body' => pages_render('listagem', array('grid' => $grid)));
}


function pages_admin_login_redirect() {
    global $config;

    header('HTTP/1.0 403 Permission Denied');
    header('Location: ' . $config['baseurl_admin'] . '/login');
    exit;
}

function pages_admin_perm_logado() {
    return isset($_SESSION['#admin']['uid']);
}

function page_admin_logout() {
    global $config;

    unset($_SESSION['#admin']);
    header("Location: " . $config['baseurl_admin'] . "/");
    exit;
}

function page_admin_login() {
    return array('page_title' => 'Login', 'body' => pages_render('login'));
}


function page_admin_home() {

    return array('page_title' => 'Home', 'body' => pages_render('home', array()));
}




function page_admin_produtos($id = null){
        global $config;

    
        //GRID
            $grid['name'] = "Produtos";
            $grid['titles'] = array('Imagem','Nome','Status');
    
            $grid['config'] = array(
            'show-search' => false,
            'show-pagination' => false,
            'pagination-default' => 50,
            'show-search-get' => false,
            'order-colum' => 1,
            'order-by' => 'ASC',
        );
    
        $grid['buttons-head'] = array(
            array(
                'title' => 'Novo', 
                'command' => '', 
                'icon' => 'icon-plus-circle2 text-primary', 
                'url' => '?type=novo'
            ),
        );
    
        $tm = db_mysql_query("SELECT * FROM produtos ORDER BY sid DESC");
        while($r = db_mysql_fetch($tm)){
    
            //GRID
            $grid['items'][$r['sid']] = array(
                '<a href="'.$r['imagem'].'" target="_blank"><img src="'.$r['imagem'].'" height="42"></a>',
                $r['nome'],
                $r['status'],
                'buttonsGrid' => array(),
        );

            if($_SESSION['#admin']['tipo'] == '2' && $r['status'] == 'pendente'){
                $grid['items'][$r['sid']]['buttonsGrid'][] = array('title' => 'Em analise', 'command' => '', 'icon' => 'icon-pencil5', 'url' => 'produtos/' . $r['sid'] . '?type=analise&id='.$r['sid']);
            }
            if($_SESSION['#admin']['tipo'] == '1' && $r['status'] == 'pendente'){
                $grid['items'][$r['sid']]['buttonsGrid'][] = array('title' => 'Em analise', 'command' => '', 'icon' => 'icon-pencil5', 'url' => 'produtos/' . $r['sid'] . '?type=analise&id='.$r['sid']);
            }
        
            if($_SESSION['#admin']['tipo'] == '1' && $r['status'] == 'em analise'){
                $grid['items'][$r['sid']]['buttonsGrid'][] = array('title' => 'Alterar Status', 'command' => '', 'icon' => 'icon-pencil5', 'url' => 'produtos/' . $r['sid'] . '?type=status&id='.$r['sid']);
            }

            $grid['items'][$r['sid']]['buttonsGrid'][] = array('title' => 'Editar', 'command' => '', 'icon' => 'icon-pencil5', 'url' => 'produtos/?id=' . $r['sid'] . '&type=editar');
            $grid['items'][$r['sid']]['buttonsGrid'][] = array('title' => 'Remover', 'command'=> 'class="text-danger-600"', 'icon' => 'icon-trash', 'url' => '?type=remover&id='.$r['sid']);
        }
    
        //INFORMAÇÃO DA TABELA
        $info = array(
            'id' => 'sid',
            'table' => 'produtos',
            'url_page_base' => 'produtos',
            'status=' . (isset($_GET['status']) ? $_GET['status'] : '') . '&' .
            'tipo=' . (isset($_GET['tipo']) ? $_GET['tipo'] : '') . '&' .
            '',
        );

        $id = $_GET['id'];
        if (isset($_POST) && $_POST) {
            if (isset($_GET['type']) && ($_GET['type'] == 'editar' || $_GET['type'] == 'novo')) {
                $editando = (isset($_GET['type']) && $_GET['type'] == 'editar');		
                $save = $_POST;     
                
                if ($editando) {
                    $save[$info['id']] = $id;
                }

                if($id)
                    $save['sid'] = $id;
                    
    
                if (isset($_FILES['logo']['size']) && $_FILES['logo']['size']) {
                    $upload = curl_envia_arquivo($config['static_baseurl'].'/afrinvest/recebe-arquivo.php', $_FILES['logo']['tmp_name'], $_FILES['logo']['name']);
                    if(!$upload || $upload['erro']){
                        return encode(array('status' => false, 'msg' => 'Erro ao salvar a logo.'));;
                    }else{
                        $save['logo'] = $upload['arquivo'];
                    }
                }

                $save['status'] = 'pendente';
    
                if (isset($_FILES['imagem']['size']) && $_FILES['imagem']['size']) {
                    $upload = curl_envia_arquivo($config['static_baseurl'].'/gabrieluploads/recebe-arquivo.php', $_FILES['imagem']['tmp_name'], $_FILES['imagem']['name']);
                    if(!$upload || $upload['erro']){
                        return encode(array('status' => false, 'msg' => 'Erro ao salvar a imagem.'));;
                    }else{
                        $save['imagem'] = $upload['arquivo'];
                    }
                }

            
                //SALVA NO BANCO
                if (db_mysql_save($info['table'], $save)) {

                    $_id = $id ? $id : db_mysql_last_insert_id();
                    $_tipo = $id ? 'UPDATE' : 'INSERT';
                    $log = db_mysql_fetch(db_mysql_query("SELECT * FROM %s WHERE %s = %s", array($info['table'], $info['id'], $_id)));
                    return encode(array('status' => true, 'msg' => 'Dados salvos com sucesso.', 
                        'url' => $config['baseurl_admin'].'/produtos'));
                } else {
                    return encode(array('status' => false, 'msg' => 'Não foi possível salvar os dados.'));
                }
                exit;
            }
        }
            //REMOVER ITENS
        
        if (isset($_GET['type']) && isset($_GET['id']) && $_GET['id'] && $_GET['type'] == 'remover') {
            if (db_mysql_query("DELETE FROM %s WHERE %s = %s", array($info['table'], $info['id'], $_GET['id']))) {
                Header("Location: " . $config['baseurl_admin'].'/produtos');
                exit;
            } else {
                $log = db_mysql_fetch(db_mysql_query("SELECT * FROM %s WHERE %s = %s", array($info['table'], $info['id'], $_GET['id'])));
                Header("Location: ?" . $config['baseurl_admin'].'/produtos' . "alerta-erro");
                exit;
            }
        }	

        if (isset($_GET['type']) && isset($_GET['id']) && $_GET['id'] && $_GET['type'] == 'analise') {
            if (db_mysql_query("UPDATE %s SET status = 'em analise' WHERE %s = %s", array($info['table'],$info['id'], $_GET['id']))) {
                Header("Location: " . $config['baseurl_admin'].'/produtos');
                exit;
            } else {
                $log = db_mysql_fetch(db_mysql_query("SELECT * FROM %s WHERE %s = %s", array($info['table'], $info['id'], $_GET['id'])));
                Header("Location: ?" . $config['baseurl_admin'].'/produtos' . "alerta-erro");
                exit;
            }
        }	

        if (isset($_GET['type']) && ($_GET['type'] == 'editar' || $_GET['type'] == 'novo')) {

            $edit = db_mysql_fetch(db_mysql_query("SELECT * FROM  %s WHERE %s = %d",array($info['table'],$info['id'], $id)));


            $form = array(
                'id' => '',
                'titulo' => "Produtos",
                'descricao' => "",
                'campos' => array(
                    array('titulo' => 'Nome', 'id' => 'nome', 'tipo' => 'text', 'required' => '', 'command' => '', 'placeholder' => '', 'class' => ''),
                    array('titulo' => 'Imagem', 'id' => 'imagem', 'tipo' => 'file', 'required' => '', 'command' => '', 'placeholder' => '', 'class' => ''),
                    array('titulo' => 'Enviar','id' => 'salvar', 'tipo' => 'botao', 'class' => 'text-right', 'icone' => 'icon-arrow-right14 position-right' ),
                ),
            );
         return array('page_title' => 'Novo', 'body' => pages_render('formulario', array('form'=>$form, 'edit' => $edit, 'save' => $save)));
         }
         

        if (isset($_GET['type']) && isset($_GET['id']) && $_GET['id'] && $_GET['type'] == 'status') {

            $save = $_POST;

            if (isset($_POST) && $_POST) {

                if (db_mysql_query("UPDATE %s SET status = '%s' WHERE %s = %s", array($info['table'],$save['status'], $info['id'], $_GET['id']))) {
                    return encode(array('status' => true, 'msg' => 'Dados salvos com sucesso.', 
                        'url' => $config['baseurl_admin'].'/produtos'));
                } else {
                    return encode(array('status' => false, 'msg' => 'Não foi possível salvar os dados.'));
                }
                exit;
            }

            $form = array(
                'id' => '',
                'titulo' => "Alterar Status",
                'descricao' => "",
                'campos' => array(
                    array('titulo' => 'Status', 'id' => 'status', 'tipo' => 'select', 'class' => '', 'required' => '', 'command' => '', 'placeholder' => '', 'values' => ['aprovado' => 'Aprovado', 'reprovado' => 'Reprovado']),
                    array('titulo' => 'Enviar','id' => 'salvar', 'tipo' => 'botao', 'class' => 'text-right', 'icone' => 'icon-arrow-right14 position-right' ),
                ),
            );
            return array('page_title' => 'Novo', 'body' => pages_render('formulario', array('form'=>$form, 'edit' => $edit, 'save' => $save)));
        }
    return array('page_title' => 'Cadastro', 'body' => pages_render('listagem', array(
        'grid'=>$grid,
    )));
}


function get_ajax_admin() {
    $user = get_logged_user();


    if (isset($_GET['login'])) {
        if (isset($_POST['email']) && isset($_POST['senha'])) {
            $login = logar_usuario($_POST['email'], $_POST['senha']);
            if ($login)
                return encode(array('status' => true, 'msg' => ""));
            else
                return encode(array('status' => false, 'msg' => "Usuário não encontrado."));
        }
        return encode(array('status' => false, 'msg' => "Preencha todos os campos corretamente."));
    }
}

function logar_usuario($user, $pass) {
    global $config;
    $pass = addslashes(sha1($pass));
    $r = db_mysql_fetch(db_mysql_query("SELECT * FROM admin_users WHERE email = '%s'", array($user)));
    if (!$r['uid'] || $r['pwd'] != $pass) {
        $log = array('user' => $user);
        // watchdog_admin("login:erro", "Erro para entrar no admin", "", $log);
        return false;
    }
    
    unset($r['pwd']);
    
    $_SESSION['#admin'] = $r;
    // watchdog_admin("login:sucesso", "Entrou no admin", "", $r);

    return true;
}

function show_pages($args) {
    if (!is_array($args))
        return false;

    $saida = '';
    $saida .= "<ul class='ow pagination'>";
    if ($args['atual'] != 1) {
        $saida .= "<li><a href='?page=" . $args['anterior'] . ($_GET['buscar'] ? "&buscar=" . $_GET['buscar'] : "") . "'>&larr; Voltar</a></li>";
    } else {
        $saida .= "<li class='disabled'><a href='javascript:void(1)'>&larr; Voltar</a></li>";
    }

    $i = $args['atual'] - 5;
    if ($i <= 1)
        $i = 1;

    $total = $i + 10;
    if ($total >= $args['total'])
        $total = $args['total'];

    for ($i; $i <= $total; $i++) {
        if ($i == $args['atual'])
            $saida .= "<li class=\"active\"><a href=\"?page={$i}" . ($_GET['buscar'] ? "&buscar=" . $_GET['buscar'] : "") . "\">{$i}</a></li>";
        else
            $saida .= "<li><a href=\"?page={$i}" . ($_GET['buscar'] ? "&buscar=" . $_GET['buscar'] : "") . "\">{$i}</a></li>";
    }
    if ($args['atual'] < $args['total']) {
        $saida .= "<li><a href=\"?page=" . $args['proxima'] . "" . ($_GET['buscar'] ? "&buscar=" . $_GET['buscar'] : "") . "\">Próxima &rarr;</a></li>";
    } else {
        $saida .= "<li class=\"disabled\"><a href=\"?page=" . $args['proxima'] . "" . ($_GET['buscar'] ? "&buscar=" . $_GET['buscar'] : "") . "\">Próxima &rarr;</a></li>";
    }

    $saida .= "</ul></div>";

    return $saida;
}

// esta funcao serve para vc colocar regras fora do padrao de uma grid
function formata_valor($tipo, $value, $html = 1) {
    $e = explode('|', $tipo);
    $tipo = $e[0];

    if (!isset($tipo) || !$tipo)
        return $value;
    if ($tipo == "data")
        return (isset($value) && $value ? date('d/m/Y', $value) : '');
    if ($tipo == "datahora")
        return (isset($value) && $value ? date('d/m/Y H:i', $value) : '');
    if ($tipo == "cpf")
        return tools_mascara_cpf($value);
    if ($tipo == "cnpj")
        return tools_mascara_cnpj($value);
    if ($tipo == "imagem-local")
        return '<a href="' . $config['media_baseurl'] . '/' . $value . '" target="_blank"><img width="200" src="' . $config['media_baseurl'] . '/' . $value . '" /></a>';
    if ($tipo == "imagem-url")
        return '<a href="' . $value . '" target="_blank"><img style="max-width: 200px;max-height: 200px;" src="' . $value . '" /></a>';

    if ($tipo == "status") {
        if ($value == 'ativo')
            return $html ? '<span class="label label-success">Ativo</span>' : 'Ativo';
            if ($value == 'aprovado')
            return $html ? '<span class="label label-success">Aprovado</span>' : 'Ativo';
            if ($value == 'inativo')
            return $html ? '<span class="label label-default">inativo</span>' : 'Inativo';
            if ($value == 'rejeitado')
            return $html ? '<span class="label label-danger">Rejeitado</span>' : 'Inativo';
        if ($value == 'pendente')
            return $html ? '<span class="label label-info">Pendente</span>' : 'Pendente';
        if ($value == 'cancelado')
            return $html ? '<span class="label label-danger">Cancelado</span>' : 'Cancelado';
    }

    if ($tipo == "status-resgate") {

        $labels = array(
            'created' => '<span class="label">A ordem tah em processo de ser criada <br/>(os campos order_items nao estao prontos ainda)</span>',
            'waiting' => '<span class="label label-success">A ordem esta pronta pra ser processada</span>',
            'processing' => '<span class="label label-warning" >A ordem esta sendo processada no momento</span>',
            'processed' => '<span class="label label-success"> Processado</span>',
            'failed' => '<span class="label label-danger">Falhou</span>',
            'failed_partial' => '<span class="label label-danger">Falhou</span>',
            'queued' => '<span class="label label-success">Pedido enfileirado</span>',
            'voided' => '<span class="label label-danger">Cancelado</span>',
        );
        return $html ? $labels[$value] : $labels[$value];
    }

    if ($tipo == 'chamado') {
        if ($value == 'aberto')
            return $html ? '<span class="label label-danger">Aberto</span>' : 'Aberto';
        if ($value == 'pendente')
            return $html ? '<span class="label label-info">Pendente</span>' : 'Pendente';
        if ($value == 'finalizado')
            return $html ? '<span class="label label-success" style="background-color:#660199;border-color:#660199;">Finalizado</span>' : 'Finalizado';
        if ($value == 'respondido')
            return $html ? '<span class="label label-success">Respondido</span>' : 'Respondido';
        if ($value == 'em andamento')
            return $html ? '<span class="label label-success" style="background-color:#f29801;border-color:#f29801;">Em andamento</span>' : 'Em andamento';
    }
    if ($tipo == "simnao") {
        if ($value == 1)
            return $html ? '<span class="label label-success">Sim</span>' : 'Sim';
        if ($value == 0)
            return $html ? '<span class="label label-danger">Não</span>' : 'Não';
    }

    if ($tipo == "status-dw") {
        if ($value == 1)
            return $html ? '<span class="label label-success">Ativo</span>' : 'Sim';
        if ($value == 0)
            return $html ? '<span class="label label-danger">Aguardando</span>' : 'Não';
    }


    return $value;
}
