<?php require_once('header.php'); ?>

<!-- Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><span class="text-semibold"><?php echo $form['titulo']?></span></h4>
		<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>

		<div class="heading-elements">
			<div class="heading-btn-group">
				<!-- <a class="btn btn-link btn-float has-text" href="#" onClick="$('#pontos').submit();"><i class=""></i><span>Atualizar pontos</span></a> -->
			</div>
		</div>
	</div>
</div>

<form id="pontos" data-ajax="?pontos"  style="display:none;">
	<input type="hidden" name="pontos" value="1" />
</form>



<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-flat">
				<div class="panel-body">
					<form data-ajax data-ajax-callback="ajax" <?php echo isset($_GET['type'])&&$_GET['type']=='novo'?'data-ajax-once':'';?>>
						<?php echo monta_formulario($form, $edit)?>
					</form>
			</div>
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
    	$('#planilha').val('');
    	$('#final').val(res.msg);
    },
    erro:function(res,form){

    },
    after:function(form){

    }
  };
</script>


<?php require_once('footer.php'); ?>
