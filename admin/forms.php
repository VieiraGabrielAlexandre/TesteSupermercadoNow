<?php
	function monta_formulario($args, $values){
		if(isset($args) && $args){
			foreach ($args['campos'] as $key => $campo) {
				$function = "formulario_".$campo['tipo'];
				if ($html = function_exists($function)) {
				    echo $function($campo, $values[$campo['id']]);
				} else {
				    echo "Funcção {$campo['tipo']} não existe<br />\n";
				}
				
			}
		}
	}

	function formulario_label($args, $value = null){
		$html = '<div class="form-group">';
		if(isset($args['titulo']) && $args['titulo'])
			$html .='<label>'.$args['titulo'].'</label>';		
		if(isset($args['descricao']) && $args['descricao'])
		$html .='<span class="help-block">'. $args['descricao'] .'</span>';
		$html .='</div>';

		return $html;
	}

	function formulario_hidden($args, $value = null){
		$html .='<input type="hidden" id="'. $args['id'] .'"  name="'. $args['id'] .'" '.$args['command'].' value="'. $value .'">';

		return $html;
	}

	function formulario_text($args, $value = null){
		$html = '<div class="form-group">';
		if(isset($args['titulo']) && $args['titulo'])
			$html .='<label>'.$args['titulo'].':</label>';

		$html .='<input type="text" id="'. $args['id'] .'"  name="'. $args['id'] .'" '. (isset($args['required']) && $args['required'] ? 'data-required' : '') .'  class="form-control '.$args['class'].'" '.$args['command'].' value="'. $value .'" placeholder="'.$args['placeholder'].'">';
		
		if(isset($args['descricao']) && $args['descricao'])
		$html .='<span class="help-block">'. $args['descricao'] .'</span>';
		$html .='</div>';

		return $html;
	}

	function formulario_textarea($args, $value = null){
		$html = '<div class="form-group">';
		if(isset($args['titulo']) && $args['titulo'])
			$html .='<label>'.$args['titulo'].':</label>';

		$html .='<textarea id="'. $args['id'] .'" name="'. $args['id'] .'" '. (isset($args['required']) && $args['required'] ? 'data-required' : '') .' class="form-control '.$args['class'].'" '.$args['command'].' placeholder="'.$args['placeholder'].'">'. $value .'</textarea>';
		
		if(isset($args['descricao']) && $args['descricao'])
		$html .='<span class="help-block">'. $args['descricao'] .'</span>';
		$html .='</div>';

		return $html;
	}


	function formulario_radio($args, $value = null){
		$html = '<div class="form-group">';
		if(isset($args['titulo']) && $args['titulo'])
		$html .= '<label class="display-block">'.$args['titulo'].':</label>';

		if(isset($args['values']) && $args['values']){
			foreach ($args['values'] as $key => $option) {
		$html .= '<label class="'.$args['class'].'" '.$args['command'].'>';
		$html .= '	<input type="radio" id="'. $key .'" name="'. $key .'" class="styled" '. ($value == $key ? 'checked' : '') .'>';
		$html .= 	$option;
		$html .= '</label>';
			}
		}

		if(isset($args['descricao']) && $args['descricao'])
		$html .='<span class="help-block">'. $args['descricao'] .'</span>';

		$html .='</div>';


		return $html;
	}

	function formulario_select($args, $value = null){
		$html = '<div class="form-group">';
		if(isset($args['titulo']) && $args['titulo'])
			$html .='<label class="display-block">'.$args['titulo'].':</label>';

		$html .='<select id="'. $args['id'] .'"  name="'. $args['id'] .'" '. (isset($args['required']) && $args['required'] ? 'data-required' : '') .'  class="form-control '.$args['class'].'" '.$args['command'].'>';
		if(isset($args['selecione']) && $args['selecione'])
			$html .= '<option value="">Selecione</option>';
		if(isset($args['values']) && $args['values']){
			foreach ($args['values'] as $key => $option) {
				$html .='<option '. ($value == $key ? 'selected' : '') .' value="'. $key .'">'. $option .'</option>';
			}
		}
		$html .= '</select>';
		
		if(isset($args['descricao']) && $args['descricao'])
		$html .='<span class="help-block">'. $args['descricao'] .'</span>';
		$html .='</div>';

		return $html;
	}

	function formulario_select_multiple($args, $value = null){
		$html = '<div class="form-group">';
		if(isset($args['titulo']) && $args['titulo'])
			$html .='<label class="display-block">'.$args['titulo'].':</label>';

		$html .='<select multiple id="'. $args['id'] .'"  name="'. $args['id'] .'" '. (isset($args['required']) && $args['required'] ? 'data-required' : '') .'  class="form-control '.$args['class'].'" '.$args['command'].'>';
		if(isset($args['selecione']) && $args['selecione'])
			$html .= '<option value="">Selecione</option>';
		if(isset($args['values']) && $args['values']){
			foreach ($args['values'] as $key => $option) {
				$html .='<option '. ($value == $key ? 'selected' : '') .' value="'. $key .'">'. $option .'</option>';
			}
		}
		$html .= '</select>';
		
		if(isset($args['descricao']) && $args['descricao'])
		$html .='<span class="help-block">'. $args['descricao'] .'</span>';
		$html .='</div>';

		return $html;
	}

	function formulario_botao($args, $value = null){
		return '<div class="'.$args['class'].'" '.$args['command'].'>
					<button type="submit" class="btn btn-primary">'. $args['titulo'] .' <i class="'. $args['icone'] .'"></i></button>
				</div>';
	}
        
        function formulario_link($args, $value = null){
		return '<div class="'.$args['class'].'" '.$args['command'].'> <a href="'.$args['url'].'" class="btn btn-primary '.$args['class'].'">'. $args['titulo'] .' <i class="'. $args['icone'] .'"></i></a></div>';
	}

	function formulario_file($args, $value = null){
		$html  = '<div class="form-group">';
		$html .= '	<label class="control-label">'.$args['titulo'].':</label>';
		$html .= '	<div class="">';
		$html .= '		<input type="file" id="'. $args['id'] .'"  name="'. $args['id'] .'" '. (isset($args['required']) && $args['required'] ? 'data-required' : '') .'  class="upload-single '.$args['class'].'" '.$args['command'].'>';
		$html .= '	</div>';
		if(isset($value) && $value){
			$html .= '<span class="help-block">Imagem atual: <a href="'.$value.'" target="_blank">'. $value .'</a></span>';
			$html .= '<div class="checkbox checkbox-inline" style="margin-top:0;">';
			$html .= '	<label style="padding-left:0px;" class="'.$args['class'].'" '.$args['command'].'>';
			$html .= '		<input id="'. $args['id'] .'-remover" name="'. $args['id'] .'-remover" type="checkbox" class="styled">';
			$html .= '		Remover';
			$html .= '	</label>';
			$html .= '</div>';
		}
		$html .= '</div>';
		return $html;
	}


	// custom
	function formulario_tipos_usuario($args, $value = null){
		$value = $value?json_decode($value,1):null;
		$check_all = false;
		if($value[0] == '*')
			$check_all = true;
			global $_TIPOS_PERFIL;

		$html = '<div class="form-group">';

		foreach ($_TIPOS_PERFIL as $b => $bt) {
		    $html .= '  <div class="checkbox checkbox-inline" style="margin-top:0;">';
		    $html .= '		<label style="padding-left:0px;" class="'.$args['class'].'" '.$args['command'].'>';
		    $html .= '			<input '. (in_array($b,$value)||$check_all?'checked':'') .' id="'.$b.'" name="'.$b.'" type="checkbox" class="styled">';
		    $html .= $bt;
		    $html .= '		</label>';
		    $html .= '	</div>';
		    $html .= '	&nbsp;&nbsp;&nbsp;';
		}
		$html .='</div>';

		return $html;
	}
