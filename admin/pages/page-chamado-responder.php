<?php require_once('header.php'); ?>

<!-- Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><span class="text-semibold"><?php echo $usuario['nome']?> | <?php echo tools_mascara_cpf($usuario['cpf']) ?> | <?php echo $usuario['tel_celular']?></span></h4>
		<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

		<div class="heading-elements">
			<div class="heading-btn-group">
				<?php 
					if(isset($grid['buttons-head']) && $grid['buttons-head']){
						foreach ($grid['buttons-head'] as $b => $bt) {
							echo '<a class="btn btn-link btn-float has-text" href="'.$bt['url'].'"><i class="'.$bt['icon'].'"></i><span> '.$bt['title'].'</span></a>';
						}
					}
				?>
			</div>
		</div>
	</div>
</div>





<div class="content">
	<div class="row">
		<div class="col-lg-9">
			<!-- Messages -->
			<div class="timeline-row">
				<div class="panel panel-flat timeline-content">

					<div class="panel-body">
						<h2>Assunto: <?php echo $chamado['assunto']?></h2>
						<ul class="media-list chat-list content-group">
							<li class="media date-step">
								<span>Conversa</span>
							</li>
							<?php
								if(isset($conversa) && $conversa){
									foreach ($conversa as $key => $value) {
							?>

							<?php if($value['tipo'] == "admin"){?>
							<li class="media reversed">
								<div class="media-body">
									<div class="media-content"><?php echo $value['mensagem']?></div>
									<span class="media-annotation display-block mt-10"> <?php echo date('d/m/Y H:i', $value['data'])?> <a href="#"><i class="icon-calendar3 position-right text-muted"></i></a></span>
								</div>

								<div class="media-right">
									<a href="#" onClick="return false;">
										<img src="<?php echo $config['static_baseurl']?>/images/webclip.jpg" class="img-circle" alt="">
									</a>
								</div>
							</li>
							<?php } ?>

							<?php if($value['tipo'] == "usuario"){?>
							<li class="media">
								<div class="media-left">
									<a href="#" onClick="return false;">
										<img src="<?php echo (isset($usuario['foto']) && $usuario['foto'] ? $usuario['foto'] : $config['static_baseurl'].'/images/img_perfil.jpg') ?>" class="img-circle" alt="">
									</a>
								</div>

								<div class="media-body">
									<div class="media-content"><?php echo $value['mensagem']?></div>
									<span class="media-annotation display-block mt-10"> <?php echo date('d/m/Y H:i', $value['data'])?> <a href="#"><i class="icon-calendar3 position-right text-muted"></i></a></span>
								</div>
							</li>
							<?php } ?>


							<?php
									}
								}
							?>




						</ul>

						<form data-ajax="chamado" method="POST" data-ajax-callback="ajax" data-ajax-sem-mensagem="sucesso">
				        	<input type="hidden" value="<?php echo $chamado['cid']?>" name="chamado_id" id="chamado_id">
				        	<div class="form-group">
				        	<textarea name="mensagem" data-required id="mensagem" class="form-control content-group" rows="3" cols="1" placeholder="Entre com a sua mensagem"></textarea>
				        	</div>
				        	<div class="row">
				        		<div class="col-xs-6">
									<button type="button" onclick="location.href='/admin/chamados'" class="btn"><i class=" icon-arrow-left13 position-left"></i>Voltar</button>
				        		</div>

				        		<div class="col-xs-6 text-right">
									<button type="submit" class="btn btn-primary">Enviar <i class="icon-arrow-right14 position-right"></i></button>
				        		</div>
				        	</div>
			        	</form>
					</div>
				</div>
			</div>
			<!-- /messages -->
		</div>
	</div>
</div>

<script>
  var callback_ajax = {
    before:function(form,formData){
      //formData = Object.toFormData(/*{Object|Array}*/) // json para formData
      return formData;
    },
    sucesso:function(res,form){
    	window.location.href =window.location.href;
    },
    erro:function(res,form){

    },
    after:function(form){

    }
  };
</script>

<?php require_once('footer.php'); ?>

