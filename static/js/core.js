var CPF = new CPF();

$(function() {

	$(".date").mask("99/99/9999",{placeholder:"dd/mm/yyyy"});
	$(".2numero").mask("9?9");
	$(".cpf").mask("999.999.999-99");
	$(".cnpj").mask("99.999.999/9999-99");
	$('.phone').mask("(99) 9999-9999?9").focusout(function (event) {  
	    var target, phone, element;  
	    target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
	    phone = target.value.replace(/\D/g, '');
	    element = $(target);  
	    element.unmask();  
	    if(phone.length > 10) {  
	        element.mask("(99) 99999-999?9");  
	    } else {  
	        element.mask("(99) 9999-9999?9");  
	    }  
	});
	$(".cep").mask("99999-999");
	$('.preco').priceFormat({prefix: '',centsSeparator: ',',thousandsSeparator: '.'});

	// LOGIN
	$("#form_login").submit(function(){
		erro=0;
		$('.inp-erro', this).removeClass('inp-erro');
		$('.inp-erro-icon', this).remove('');
		$('.login-erro', this).fadeOut();

		cpf = $("#login").val();
		pwd = $("#pwd").val();

		if(!cpf || !CPF.valida(cpf)){
			erro=1;
			$('#login').addClass('inp-erro');
			$('#login').before('<div class="inp-erro-icon"></div>');
		}
		if(!pwd){
			erro=1;
			$('#pwd').addClass('inp-erro');
			$('#pwd').before('<div class="inp-erro-icon"></div>');
		}

		if(erro == 1){
			$('.login-erro', this).fadeIn();
			return false;
		}
		return true;
	});

	// ESQUECI SENHA
	$("#form_esqueci_senha").submit(function(){
		erro=0;
		$('.inp-erro', this).removeClass('inp-erro');
		$('.inp-erro-icon', this).remove('');
		$('.login-erro', this).fadeOut();

		email = $("#esqueci_email").val();
		//*
		cpf = $("#esqueci_cpf").val();
		/*/
		cnpj = $("#esqueci_cnpj").val();
		//*/

		if(!email || !$.validateEmail(email)){
			erro=1;
			$('#esqueci_email').addClass('inp-erro');
			$('#esqueci_email').before('<div class="inp-erro-icon"></div>');
		}

		//*
		if(!cpf || !CPF.valida(cpf)){
			erro=1;
			$('#esqueci_cpf').addClass('inp-erro');
			$('#esqueci_cpf').before('<div class="inp-erro-icon"></div>');
		}
		/*/
		if(!cnpj){
			erro=1;
			$('#esqueci_cnpj').addClass('inp-erro');
			$('#esqueci_cnpj').before('<div class="inp-erro-icon"></div>');
		}
		//*/

		if(erro == 1){
			$('.login-erro', this).fadeIn();
			return false;
		}
		return true;
	});


	// NOVA SENHA
	$("#form-reset-user-register").submit(function(){
		var senha = $("#inputSenha").val();
		var confsenha = $("#inputConfSenha").val();


		erro=0;
		$('.inp-erro', this).removeClass('inp-erro');
		$('.inp-erro-icon', this).remove('');
		$('.login-erro', this).fadeOut();

		
		if(!senha || !confsenha){
			$('#inputConfSenha').addClass('inp-erro');
			$('#inputConfSenha').before('<div class="inp-erro-icon"></div>');
			error = 1;
		}
		if(senha != confsenha){
			$('#inputConfSenha').addClass('inp-erro');
			$('#inputConfSenha').before('<div class="inp-erro-icon"></div>');
			error = 1;
		}
		if(error){
			$('.login-erro', this).fadeIn();
			return false;
		}
	});

	// VALIDAÇÃO DE FORM
	$("#form").submit(function(){
		erro=0;
		$('.inp-erro', this).removeClass('inp-erro');
		$('.inp-erro-icon', this).remove('');
		$('.msg-erro', this).fadeOut();

		validacao_input = ['nome', 'cpf', 'loja', 'cnpj', 'cargo','email','telefone', 'assunto', 'mensagem']; // CAMPOS OBRIGATÓRIOS
		$.each(validacao_input, function(i, v){
			if(!$("#"+v).val()){
				erro=1;			
				$("#"+v).addClass('inp-erro');
				$("#"+v).before('<div class="inp-erro-icon"></div>');
			}
		});
		if(erro == 1){
			$('.msg-erro', this).fadeIn();
			return false;
		}
		return true;
	});

	//valida emails
	$.validateEmail = function (email){
		er = /^[a-zA-Z0-9][a-zA-Z0-9\._-]+@([a-zA-Z0-9\._-]+\.)[a-zA-Z-0-9]{2}/;
		if(er.exec(email))
			return true;
		else
			return false;
	};	
});


function consulta_cep(cep){
	cep = er_replace( /[^0-9]+/g,'', cep);
	if(!cep) return false;
	$.ajax({
      type: 'POST',
      url: '/ajax?consulta-cep',
      dataType: 'json',
      cache: false,
      timeout: 3000,
      data: {'cep' : cep},
      error: function() {
        console.log('erro');
      },
      success: function(data) {
      	if(!data.status){ //errro
			// anima_alerta('meusdados-error');
      	} else {
      		$('#estado').val(data.estado);
      		$('#cidade').val(data.cidade);
      		$('#endereco').val(data.endereco);
      		$('#bairro').val(data.bairro);
      	}
      }
   });
}

function er_replace(pattern, replacement, subject){
	return subject.replace( pattern, replacement );
}

function CPF(){"use strict";function r(r){for(var t=null,n=0;9>n;++n)t+=r.toString().charAt(n)*(10-n);var o=t%11,i=11-o;return 2>o&&(i=0),i}function t(r){for(var t=null,n=0;10>n;++n)t+=r.toString().charAt(n)*(11-n);var o=t%11,i=11-o;return 2>o&&(i=0),i}function n(r){var t=r.replace(/\.|\-|\s/g,"");return t}function o(r,t){var n=".",o="-";return"digitos"===t?(n="",o=""):"verificador"===t&&(n="",o="-"),/^[0-9]+$/.test(r)?r.length>11?"O valor informado contém erro. Está passando dígitos.":r.length<11?"O valor informado contém erro. Está faltando dígitos.":r.slice(0,3)+n+r.slice(3,6)+n+r.slice(6,9)+o+r.slice(9,11):"O valor informado contém caracteres inválidos."}this.gera=function(n){for(var i="",a=0;9>a;++a)i+=Math.floor(9*Math.random())+"";var e=r(i),s=i+e+t(i+e);return o(s,n)},this.valida=function(o){for(var i=n(o),a=i.substring(0,9),e=i.substring(9,11),s=0;10>s;s++)if(""+a+e===Array(12).join(s))return!1;var c=r(a),u=t(a+""+c);return e.toString()===c.toString()+u.toString()?!0:!1},this.formata=function(r,t){var i=n(r);return o(i,t)}}
