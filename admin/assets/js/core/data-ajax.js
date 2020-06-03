var CONFIG = {
	baseurl:'http://' + window.location.hostname,
	ajax_path:'/ajax-admin?',
	input: {
		erro: {
			classe:'has-error',
			icone:{
				classe:'', // icons
				caractere:'' // 
			}
		}
	},
	form:{
		erro:{
			mensagem:'Preencha todos os campos.'
		}
	},
	ajax:{
		erro:{
			mensagem:'Algo errado. Tente novamente.'
		},
		sucesso:{
			mensagem:'Salvo com sucesso.'
		}
	},
	alerta:{
		padrao:{
			fundo:'#F1C905',
			fonte:'#FFF',
			classe:'alerta-fixo',
		},
		erro:{
			fundo:'#bc2b14',
			fonte:'#FFF',
			classe:'alerta-erro',
		},
		sucesso:{
			fundo:'#a6cf4f',
			fonte:'#FFF',
			classe:'alerta-sucesso'
		}
	}
}
dataajaxcss=(function(){
	var cssHtml = '';
	cssHtml += '.'+CONFIG.alerta.padrao.classe+'{position: fixed;z-index: 99999;width: 100%;min-height: 40px;line-height: 38px;text-align: center;left: 0px;border: 0px;color: #FFF;font-size: 14px;font-weight: 700;}';
	cssHtml += '.'+CONFIG.alerta.padrao.classe+'{background-color:'+CONFIG.alerta.padrao.fundo+';color:'+CONFIG.alerta.padrao.fonte+';}';
	cssHtml += '.'+CONFIG.alerta.sucesso.classe+'{background-color:'+CONFIG.alerta.sucesso.fundo+';color:'+CONFIG.alerta.sucesso.fonte+';}';
	cssHtml += '.'+CONFIG.alerta.erro.classe+'{background-color:'+CONFIG.alerta.erro.fundo+';color:'+CONFIG.alerta.erro.fonte+';}';
	var style = document.createElement('style');
	style.type = 'text/css';
	style.innerHTML = cssHtml;
	document.getElementsByTagName('head')[0].appendChild(style);
	return true;
})();

function bind_forms_input_data(){
	$(function() {
		$.each($('[data-ajax-input]:input'),function(i,e){
			if($(this).data('dataAjaxInput')) return false;
			
			$(this).data('dataAjaxInput',1);
			$(this).on('change.dataAjaxInput',function(){
				if($(this).is('[data-ajax-input-form]'))
					$form = $( $(this).attr('data-ajax-input-form') );
				else
					$form = $(this).closest("form");

				if(!$form){
					window.console&&console.warn('Formulário '+$(this).attr('data-ajax-input-form')+' não encontrado.');
					return false;
				}

				$input = $( '#'+$(this).attr('data-ajax-input')+':input' ,$form);
				if(!$input){
					window.console&&console.warn('Input #'+$(this).attr('data-ajax-input-form')+ ' não encontrado dentro do form.');
					return false;
				}

				var ajax_data = $(this).wrap('<form></form>');
				ajax_data.after('<input type="hidden" name="data-ajax-input" value="1">');

				formData = new FormData(ajax_data.parent()[0]);
				setTimeout(function(){
					ajax_data.next().remove();
				},1);

				ajax_form('', formData, function(r){
					ajax_data.unwrap();

					$input.find('option[value]').remove();
					$.each(r.data,function(k,v){
						$input.append('<option value="'+k+'">'+v+'</option>');
					});
				},function(){
					ajax_data.unwrap();
				});

			});
		});
	});
}
bind_forms_input_data();

function bind_forms_data(){
	$(function() {

		$(document).unbind('keypress').bind('keypress',function(e) {
			if(e.which == 13) {
				if(!$(e.target).is('input[type=text]')) return true;
				if($(e.target).closest('form[data-ajax]').length){
					$(e.target).closest('form[data-ajax]').each(function(){
						$(this).submit();
					})
				}
			}
		});
		
		$.each($('form[data-ajax]'),function(i,e){
			var $form = $(this);
			$form.unbind('submit').bind('submit',function(){
				if($form.data('locked')) return false;
				var form_erro = false;

				if(CONFIG.input.erro.icone.classe)
					$('.'+CONFIG.input.erro.icone.classe,$form).parent().remove();

				if(CONFIG.input.erro.classe)
					$('.'+CONFIG.input.erro.classe).removeClass(CONFIG.input.erro.classe);

				var adicionar_icone_erro = (function(input){
					if(CONFIG.input.erro.icone.caractere || CONFIG.input.erro.icone.classe){
						input.after('<div class="form-control-feedback" style="right:0;left:auto;"><i class="'+CONFIG.input.erro.icone.classe+'"></i></div>').next().fadeIn();
					}
				});
				$.each($('[data-required]',$form),function(){
					var $input = $(this);
					if($input.is('[type="checkbox"]') && !$input.is(':checked')){
						$input.before('<input type="hidden" name="'+$input.attr('name')+'" value="" data-required data-auto-generated-validator>');
					}
					if($input.is('[type="file"]') && !$input.val()){
						$input.before('<input type="hidden" name="'+$input.attr('name')+'" value="" data-required data-auto-generated-validator>');
					}
				});


				var data = $form.formToData();

				$.each(data,function(name,value){
					var $input = $('[name="'+name+'"]',$form);

					if($input.is('[data-required]')){
						if(!value || !value.length){
							form_erro = true;
							$input.closest('.form-group').addClass(CONFIG.input.erro.classe);
							// if($input.closest('.input-special').length)
							// 	$input.siblings('label:eq(0)').addClass(CONFIG.input.erro.classe);
							if(!$input.is('[type="radio"],[type="checkbox"]')){
								adicionar_icone_erro($input);
							}
						}
					}
				});

				// checo os campos esteticos, que não tem name e não são enviados
				$.each($('[data-required]:not([name])',$form),function(element,index){
					var $input = $(this,$form);
					var value = $input.val();
					if(!value || !value.length){
						form_erro = true;
						// if($input.closest('.input-special').length)
							// $input.siblings('label:eq(0)').addClass(CONFIG.input.erro.classe);
						$input.closest('.form-group').addClass(CONFIG.input.erro.classe);
						if(!$input.is('[type="radio"],[type="checkbox"]'))
							adicionar_icone_erro($input);
					}
				});

				$('[data-auto-generated-validator]',$form).remove();

				var markInput = function(inp,status){
					if(!status) status = 'erro';
					inp.closest('.form-group').addClass(CONFIG.input.erro.classe);
					// if(inp.closest('.input-special').length)
					// 	inp.siblings('label:eq(0)').addClass(CONFIG.input[status].classe);
				}

				var before_callback = function(r){};
				if($form.is('[data-ajax-callback]')){
					var callback = $form.attr('data-ajax-callback').replace(/^callback_/, '');
					var before_callback = (typeof window['callback_'+callback] !== "undefined" && window['callback_'+callback].before !== "undefined" ? window['callback_'+callback].before : function(r){});
				}
				var formData = new FormData($($form)[0]);
				var cb = before_callback($form,formData,markInput);
				if(cb === false || cb === 0)
					form_erro=true;
				else if(cb)
					formData = cb;

				if($form.is('[data-ajax-callback]')){
					var callback = $form.attr('data-ajax-callback').replace(/^callback_/, '');

					var sucesso_callback = (typeof window['callback_'+callback] !== "undefined" && window['callback_'+callback].sucesso !== "undefined" ? window['callback_'+callback].sucesso : function(r){});
					var erro_callback = (typeof window['callback_'+callback] !== "undefined" && window['callback_'+callback].erro !== "undefined" ? window['callback_'+callback].erro : function(r){});
					var input_erro_callback = (typeof window['callback_'+callback] !== "undefined" && window['callback_'+callback].input_erro !== "undefined" ? window['callback_'+callback].input_erro : function(r){});

					var after_callback = (typeof window['callback_'+callback] !== "undefined" && window['callback_'+callback].after !== "undefined" ? window['callback_'+callback].after : function(r){});
				}else{
					var sucesso_callback = function(r){};
					var erro_callback = function(r){};
					var input_erro_callback = function(r){};

					var after_callback = function(r){};
				}

				if(!form_erro){

					var lock_form = false;
					if($form.is('[data-ajax-once]'))
						lock_form = true;

					$form.data('locked',1);
					if($('body').find("[data-ajax-loading]").length)
						$('body').find("[data-ajax-loading]").fadeIn('fast');

					var aindaSalvando = setTimeout(function(){
						if(aindaSalvando)
							alerta(null,'Ainda carregando...',null,null,'proximo');
					},4000);
					ajax_form($form.attr("data-ajax"),formData,
					// ajax_form($form.attr("data-ajax"),data,
						function(data){
							clearTimeout(ajax_form);
							clearTimeout(aindaSalvando);
							aindaSalvando = false;
							if(!$form.is('[data-ajax-sem-mensagem="sucesso"],[data-ajax-sem-mensagem=""]')){
								alerta(CONFIG.alerta.sucesso.classe,(data&&data.msg?data.msg:CONFIG.ajax.sucesso.mensagem));
							}else{
								$('[data-alerta-sumir-no-proximo]').animate({
									bottom: '-'+$(this).outerHeight()+'px'
								},'normal',function(){
									$(this).remove();
								});
							}
							if(after_callback) after_callback($form);
							if(sucesso_callback) sucesso_callback(data,$form,markInput);
							if($('body').find("[data-ajax-loading]").length)
								$('body').find("[data-ajax-loading]").fadeOut('fast');
							if(!lock_form)
								$form.removeData('locked');
						},function(data){
							clearTimeout(ajax_form);
							clearTimeout(aindaSalvando);
							aindaSalvando = false;
							if(!$form.is('[data-ajax-sem-mensagem="erro"],[data-ajax-sem-mensagem=""]')){
								alerta(CONFIG.alerta.erro.classe,(data&&data.msg?data.msg:CONFIG.ajax.erro.mensagem));
							}else{
								$('[data-alerta-sumir-no-proximo]').animate({
									bottom: '-'+$(this).outerHeight()+'px'
								},'normal',function(){
									$(this).remove();
								});
							}
							if(after_callback) after_callback($form);
							if(erro_callback) erro_callback(data,$form,markInput);
							if($('body').find("[data-ajax-loading]").length)
								$('body').find("[data-ajax-loading]").fadeOut('fast');
							if($form.data('locked'))
								$form.removeData('locked');

							if(data && data['#fields_error']){
								if(typeof data['#fields_error'] == 'string')
									data['#fields_error'] = data['#fields_error'].split(',');
								$.each(data['#fields_error'], function(i,e){
									markInput($('[name="'+e+'"]',$form));
								});
							}
						}
					);
				}else{
					clearTimeout(aindaSalvando);
					aindaSalvando = false;
					if(!$form.is('[data-ajax-sem-mensagem="erro"],[data-ajax-sem-mensagem=""]')){
						if($form.is('[data-ajax-erro-mensagem]'))
							alerta(CONFIG.alerta.erro.classe,$form.attr('data-ajax-erro-mensagem'));
						else
							alerta(CONFIG.alerta.erro.classe,CONFIG.form.erro.mensagem);
					}
				}
				return false;
			});

			$('[data-submit]',$form).unbind('click').bind('click',function(){
				$form.submit();
				return false;
			});
		});

	});
}
bind_forms_data();

function ajax_form(url,data,success,error,deep_error){
	data = typeof data == "undefined"?{}:data;
	success = typeof success == "undefined"?(function(){}):success;
	error = typeof error == "undefined"?(function(){}):error;
	deep_error = typeof deep_error == "undefined"?(function(){console.log('Deep ajax error or not json at '+url,data);error();}):deep_error;

	$.ajax({
		type: 'POST',
		url: CONFIG.baseurl+CONFIG.ajax_path+url,
		dataType: 'json',
		cache: false,
		contentType: false,
		processData: false,
		timeout: 0,
		data: data,
		error:function(r){
			deep_error(r);
		},
		success: function(data){
			if(!data.status)
				error(data);
			else
				success(data);
		}
	});
}

function alerta(classe,mensagem,scrollTo,direction,time){
	classe = typeof classe === "undefined"?'':classe;
	mensagem = typeof mensagem === "undefined"?'':mensagem;
	direction = typeof direction === "undefined"?'bottom':direction;
	scrollTo = typeof scrollTo === "undefined"?false:scrollTo;
	time = typeof time === "undefined"?5000:time;

	if(scrollTo)
		$("html,body").animate({scrollTop:scrollTo.offset().top},'5000');

	if(direction == 'top'){
		var alerta = $(document.createElement('div')).css('border-bottom-width','1px').addClass(''+CONFIG.alerta.padrao.classe+' '+(classe?classe:'')).text(mensagem?mensagem:'').appendTo('body')[0];
		$(alerta).css('top','-'+$(alerta).outerHeight()+'px');
		$(alerta).animate({
			top: '0px'
		},'fast',function(){
			$('[data-alerta-sumir-no-proximo]').remove();
			if(time!='proximo'){
				setTimeout(function(){
					$(alerta).animate({
						top: '-'+$(alerta).outerHeight()+'px'
					},'fast',function(){
						$(alerta).remove();
					});
				},time);
			}else{
				$(alerta).attr('data-alerta-sumir-no-proximo',1);
			}
		});
	}else{
		var alerta = $(document.createElement('div')).css('border-top-width','1px').addClass(''+CONFIG.alerta.padrao.classe+' '+(classe?classe:'')).text(mensagem).appendTo('body')[0];
		$(alerta).css('bottom','-'+$(alerta).outerHeight()+'px');
		$(alerta).animate({
			bottom: '0px'
		},'fast',function(){
			$('[data-alerta-sumir-no-proximo]').remove();
			if(time!='proximo'){
				setTimeout(function(){
					$(alerta).animate({
						bottom: '-'+$(alerta).outerHeight()+'px'
					},'fast',function(){
						$(alerta).remove();
					});
				},time);
			}else{
				$(alerta).attr('data-alerta-sumir-no-proximo',1);
			}	
		});
	}
}


$(function() {
	$.fn.formToData = function(){
		var o = {};
		var a = this.serializeArray();

		a = a.concat(
			$('input[type=checkbox]:not(:checked)',this).map(function(){
				return {"name": this.name, "value": ''}
			}).get()
    	);

    	var radio_groups = {}
		$(":radio",this).each(function(){
		    radio_groups[this.name] = this.value;
		})

		for(group in radio_groups){
			var radio = $(":radio[name='"+group+"']:checked");
		    var if_checked = !!radio.length
		    var val = if_checked?radio.val():'';

		    a = a.concat( {name:group,value:val} );
		}

		$.each(a, function() {
			if (o[this.name] !== undefined) {
				if (!o[this.name].push) {
					o[this.name] = [o[this.name]];
				}
				o[this.name].push(this.value || '');
			} else {
				o[this.name] = this.value || '';
			}
		});
		return o;
	};

	// .on("destroyed")
	$.event.special.destroyed = {
		remove:function(o){
			o.handler.apply(this,arguments);
		}
	}
});

Object.size = function(obj) {
	var size = 0, key;
	for (key in obj) {
		if (obj.hasOwnProperty(key)) size++;
	}
	return size;
};

var defineProp = function (obj, propName, value, writable) {
    try {
        Object.defineProperty(obj, propName, {
            enumerable: false,
            configurable: true,
            writable: writable,
            value: value
        });
    } catch(error) {
        obj[propName] = value;
    }
};


// json to formData
// Object.toFormData(object /*{Object|Array}*/);
!function(a){"use strict";function b(a){return j.call(a).slice(8,-1)}function c(a){var b=l.call(a,function(a){return"["+a+"]"});return b[0]=a[0],b.join("")}function d(a){var d=new h,e=function(a,e,f,g){var h=b(e);switch(h){case"Array":break;case"Object":break;case"FileList":return k.call(e,function(a,b){var e=g.concat(b),f=c(e);d.append(f,a)}),!0;case"File":var i=c(g);return d.append(i,e),!0;case"Blob":var i=c(g);return d.append(i,e,e.name),!0;default:var i=c(g);return d.append(i,e),!0}};return Object.traverse(a,e,null,null,!0),d}var e=a.Blob,f=a.File,g=a.FileList,h=a.FormData,i=e&&f&&g&&h,j=Object.prototype.toString,k=Array.prototype.forEach,l=Array.prototype.map;i&&(Object.toFormData=d)}(window);
!function(a){"use strict";function b(a){return a instanceof Object}function c(a){return"number"==typeof a&&!h(a)}function d(a,c,d,e,f,h){var i=[[],0,g(a).sort(),a],j=[];do{var k=i.pop(),l=i.pop(),m=i.pop(),n=i.pop();for(j.push(k);l[0];){var o=l.shift(),p=k[o],q=n.concat(o),r=c.call(d,k,p,o,q,m);if(r!==!0){if(r===!1){i.length=0;break}if(!(m>=h)&&b(p)){if(-1!==j.indexOf(p)){if(f)continue;throw new Error("Circular reference")}if(!e){i.push(n,m,l,k),i.push(q,m+1,g(p).sort(),p);break}i.unshift(q,m+1,g(p).sort(),p)}}}}while(i[0]);return a}function e(a,b,e,g,h,i){var j=b,k=e,l=1===g,m=!!h,n=c(i)?i:f;return d(a,j,k,l,m,n)}var f=100,g=Object.keys,h=a.isNaN;Object.traverse=e}(window);
