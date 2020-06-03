<?php require_once('header.php'); ?>

<!-- Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><span class="text-semibold"><?php echo $grid['name']?></span></h4>
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
	
	<div class="panel panel-flat">
		<table id="example" class="display" style="width:100%">
		    <thead>
		        <tr>
		        	<th>Data</th>
		        	<th>Nome</th>
		        	<th>GPID</th>
		        	<th>CPF</th>
		        	<th>E-mail</th>
		        	<th>Celular</th>
		        	<th>Ultimo login</th>
		        	<th>Status</th>
		        	<th>Qtd Login</th>
		        	<th>Diretoria</th>
		        	<th>Divisão</th>
		        	<th>Cod. Divisão</th>
		        	<th>Ação</th>
		        </tr>
		    </thead>
		    <!-- <tfoot>
		        <tr>
		            <th>Data</th>
		        	<th>Nome</th>
		        	<th>GPID</th>
		        	<th>CPF</th>
		        	<th>E-mail</th>
		        	<th>Celular</th>
		        	<th>Ultimo login</th>
		        	<th>Status</th>
		        	<th>Qtd Login</th>
		        	<th>Diretoria</th>
		        	<th>Divisão</th>
		        	<th>Cod. Divisão</th>
		        	<th>Ação</th>
		        </tr>
		    </tfoot> -->
		</table>	
	</div>

</div>

<style>
td{
    text-align: center;
}
td, th{
	padding: 11px 16px;
	border-bottom: 1px solid #00000017;
    border-right: 1px solid #00000005;
}
</style>

<!-- /page header -->


<?php require_once('footer.php'); ?>


<script>
	$(document).ready(function(){
	    $('#example').DataTable({
	        processing: true,
	        serverSide: true,
	        "ajax": "./data",
	    });
	});
</script>



<script>
	// $(document).ready(function(){
	//     $('#example').DataTable({
	//         processing: true,
	//         serverSide: true,
	//         // "sAjaxSource": "./data",
	//         "ajax": "./data",
	//    //      fnServerData:function(sSource, aoData, fnCallback, oSettings){

	//    //      	console.log('sSource',sSource);
	//    //      	console.log('aoData',aoData);
	//    //      	console.log('fnCallback',fnCallback);
	//    //      	console.log('oSettings',oSettings);

	// 			// aoData.push({ "name": "Input1", "value": "xx" });

	// 			// oSettings.jqXHR = $.ajax({
	// 			// 	"dataType": 'json',
	// 			// 	"type": "POST",
	// 			// 	"url": "./data",
	// 			// 	"data": aoData,
	// 			// 	"success": fnCallback
	// 			// });
	//    //      },
	//     });
	// });
</script>
