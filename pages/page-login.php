<?php global $config;?>
<!-- Main content -->
<div class="content-wrapper">

	<!-- Content area -->
	<div class="content">

		<!-- Simple login form -->
		<form data-ajax="login" data-ajax-callback="ajax" data-ajax-sem-mensagem>
			<div class="panel panel-body login-form" style="background: #609;color: #fff;border: 0px solid"> 
				<div class="text-center">
					<!-- <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div> -->
					<img src="<?php echo $config['static_baseurl'];?>/images/logo.jpg" style="width:100%;position:relative;left:-12px;">
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
                    <button type="submit" class="btn btn-block btn-warning">Entrar     
                        <i class="icon-circle-right2 position-right"></i>
                    </button>                                     
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
        if(res.status)
    	   window.location.href = CONFIG.baseurl + "/onda";

    },
    erro:function(res,form){
        if(res.msg)
            alerta(CONFIG.alerta.erro.classe,res.msg,null,null,20000);
    },
    after:function(form){

    }
  };
</script>