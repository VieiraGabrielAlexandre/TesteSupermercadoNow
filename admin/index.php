<?php

$parsed = parse_url($_SERVER['REQUEST_URI']);
parse_str(@$parsed['query'], $_GET);
$_GET['q'] = substr($parsed['path'], 1);

$app_basedir = dirname(__FILE__);
require_once('./bootstrap.php');
$urlhandler_map = array();
$urlhandler_map['#default'] = array('#callback' => 'page_admin_produtos', '#access' => 'pages_admin_perm_logado');
$urlhandler_map['#permission_denied'] = array('#callback' => 'pages_admin_login_redirect', '#access' => true);
$urlhandler_map['#pagenotfound'] = array('#callback' => 'pages_admin_login_redirect', '#access' => 'true');


$urlhandler_map['admin'] = array(
    'ajax-admin' => array('#callback' => 'get_ajax_admin', '#access' => true),
    'login' => array('#callback' => 'page_admin_login', '#access' => true),
    'logout' => array('#callback' => 'page_admin_logout', '#access' => 'pages_admin_perm_logado'),
    'ajax-teste' => array('#callback' => 'page_admin_ajax_teste', '#access' => 'pages_admin_perm_logado'),
 
    'home' => array('#callback' => 'page_admin_produtos', '#access' => 'pages_admin_perm_logado'),

    'usuarios' => array(
        'adicionar' => array('#callback' => 'page_admin_usuarios_adicionar', '#access' => 'pages_admin_perm_logado'),
        'remover' => array('#callback' => 'page_admin_usuarios_remover', '#access' => 'pages_admin_perm_logado'),
        'listar' => array('#callback' => 'page_admin_usuarios_admin', '#access' => 'pages_admin_perm_logado'),
    ),
    
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
            $t = array('admin/login' => 'page-login');
            $e = explode('/', $path);
            if (isset($t[$e[0]])) {
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
