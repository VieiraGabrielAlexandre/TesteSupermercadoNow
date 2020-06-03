<?php global $config;?>
<!-- Main content -->
<div class="content-wrapper">

	<!-- Content area -->
	<div class="content">

		<!-- Simple login form -->
		<form data-ajax="login" data-ajax-callback="ajax" data-ajax-sem-mensagem="sucesso">
			<div class="panel panel-body login-form" style="background:#f8f8f8;padding-top:0;">
				<div class="text-center">
					<!-- <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div> -->
					<h5 class="content-group">Entrar em sua conta <small class="display-block">Digite seus dados abaixo</small></h5>
				</div>

				<div class="form-group has-feedback has-feedback-left">
					<input type="text" class="form-control" placeholder="Email" data-required name="email">
					<div class="form-control-feedback">
						<i class="icon-user text-muted"></i>
					</div>
				</div>

				<div class="form-group has-feedback has-feedback-left">
					<input type="password" class="form-control" placeholder="Senha" data-required name="senha">
					<div class="form-control-feedback">
						<i class="icon-lock2 text-muted"></i>
					</div>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block">Entrar <i class="icon-circle-right2 position-right"></i></button>
				</div>
			</div>
		</form>
		<!-- /simple login form -->

	</div>
	<!-- /content area -->

</div>
<!-- /main content -->

<script>
  var callback_ajax = {
    before:function(form,formData){
      //formData = Object.toFormData(/*{Object|Array}*/) // json para formData
      return formData;
    },
    sucesso:function(res,form){
    	window.location.href = CONFIG.baseurl;
    },
    erro:function(res,form){

    },
    after:function(form){

    }
  };
</script>