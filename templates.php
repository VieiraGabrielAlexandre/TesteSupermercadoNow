<?php

function template_name($template = NULL) {
	global $current_template;

	if ($template) {
		$current_template = $template;
	}
	return $current_template;
}

function template_get_path($template_name = null, $type = 'page') {
	if (!$template_name) {
		return null;
	}
	$filename = "./templates/{$template_name}/{$type}.tpl.php";
	if (!file_exists($filename)) {
		return null;
	}
	return $filename;
}

function template_var($name = NULL, $value = NULL) {
	global $template_vars;

	if ($name && (is_null($value))) {
		return $template_vars[$name];
	}
	return($template_vars[$name] = $value);
}

function template_get_vars() {
	global $template_vars;
	return $template_vars;
}

function template_get_default_vars() {
	global $template_default_vars;
	return $template_default_vars;
}

function template_render($type = 'page', $variables = array()) {
	$_filepath = template_get_path(template_name(), $type);
	Header('Content-Type: text/html; charset=UTF-8');
	if (!$_filepath) {
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


