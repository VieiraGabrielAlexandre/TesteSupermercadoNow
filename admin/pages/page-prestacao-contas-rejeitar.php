<?php require_once('header.php'); ?>


<div class="content">
	<div class="row">
		<div class="col-lg-9">
			<!-- Messages -->
			<div class="timeline-row">
				<div class="panel panel-flat timeline-content">

					<div class="panel-body">
						<h2>MOTIVO</h2>
						<form data-ajax="cardapio-rejeitar" method="POST" data-ajax-callback="ajax" data-ajax-sem-mensagem="sucesso">
				        	<input type="hidden" value="<?php echo $id?>" name="cardapio" id="cardapio">
				        	<div class="form-group">
				        	<textarea name="mensagem" data-required id="mensagem" class="form-control content-group" rows="3" cols="1" placeholder="Entre com a sua mensagem"></textarea>
				        	</div>
				        	<div class="row">
				        		<div class="col-xs-6">
									<button type="button" onclick="location.href='/admin/cardapio/lista'" class="btn"><i class=" icon-arrow-left13 position-left"></i>Voltar</button>
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
    	window.location.href ='/admin/prestacao-contas/lista';
    },
    erro:function(res,form){

    },
    after:function(form){

    }
  };
</script>

<?php require_once('footer.php'); ?>

