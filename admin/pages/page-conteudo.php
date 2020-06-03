<?php require_once('header.php'); ?>


<!-- Page header -->
  <div class="page-header">
    <div class="page-header-content">

      <div class="page-title">
        <h4><span class="text-purple">Conteudo</span>
          <small class="display-block"></small>
        </h4>
      </div>

    </div>
  </div>
  <!-- /page header -->

  <!-- Page container -->
  <div class="page-container">
    <div class="panel panel-flat">
      <div class="panel-body">
      <form data-ajax data-ajax-callback="ajax" <?php echo isset($_GET['type'])&&$_GET['type']=='novo'?'data-ajax-once':'';?>>
        <?php echo monta_formulario($form, $edit)?>
      </form>
    </div>
    </div>
  </div>
  <!-- /page header -->

  <script>
  var callback_ajax = {
    before:function(form,formData){
      //formData = Object.toFormData(/*{Object|Array}*/) // json para formData
      return formData;
    },
    sucesso:function(res,form){
      if(typeof res.url !== "undefined" && res.url){
        setTimeout(function(){
          window.location.href = res.url;
        },3000);
      }
    },
    erro:function(res,form){

    },
    after:function(form){

    }
  };
</script>