<?php require_once('header.php'); ?>

<!-- Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><span class="text-semibold">Gráfico dos usuários cadastrados no TSV</span></h4>
		<a class="heading-elements-toggle"><i class="icon-more"></i></a></div>
	</div>
</div>



<div class="content">
	<!-- State saving -->

		<h4><span class="text-semibold">Filtros</span></h4>
		<div class="panel panel-flat">
			<div class="panel-body">

				<form method="get" id="filter" name="filter">
					<div class="col-md-3">

						<label>Regional</label>
						<select name="regional" onchange="this.form.submit();" class="form-control">
							<option value=""></option>							
							<?php 
								if(isset($filtros['regional']) && $filtros['regional']){
									foreach ($filtros['regional'] as $key => $value) {
										echo "<option value='". $key ."' ". (isset($_GET['regional']) && $_GET['regional'] == $key ? "selected" : "") .">". $key ."</option>";
									}
								}
							?>						
						</select>
					</div>
					<div class="col-md-3">
						<label>GC</label>
						<select name="gc" onchange="this.form.submit();" class="form-control">
							<option value=""></option>							
							<?php 
								if(isset($filtros['gc']) && $filtros['gc']){
									foreach ($filtros['gc'] as $key => $value) {
										echo "<option value='". $key ."' ". (isset($_GET['gc']) && $_GET['gc'] == $key ? "selected" : "") .">". $value ."</option>";
									}
								}
							?>
						</select>
					</div>
					<div class="col-md-2">
						<label>DDD</label>
						<select name="ddd" onchange="this.form.submit();" class="form-control">
							<option value=""></option>							
							<?php 
								if(isset($filtros['ddd']) && $filtros['ddd']){
									foreach ($filtros['ddd'] as $key => $value) {
										echo "<option value='". $key ."' ". (isset($_GET['ddd']) && $_GET['ddd'] == $key ? "selected" : "") .">". $key ."</option>";
									}
								}
							?>
						</select>
					</div>
					<div class="col-md-2">
						<label>UF</label>
						<select name="uf" onchange="this.form.submit();" class="form-control">
							<option value=""></option>							
							<?php 
								if(isset($filtros['uf']) && $filtros['uf']){
									foreach ($filtros['uf'] as $key => $value) {
										echo "<option value='". $key ."' ". (isset($_GET['uf']) && $_GET['uf'] == $key ? "selected" : "") .">". $key ."</option>";
									}
								}
							?>
						</select>
					</div>		
					<div class="col-md-2">
						<label>Redes</label>
						<select name="redes" onchange="this.form.submit();" class="form-control">
							<option value=""></option>							
							<?php 
								if(isset($filtros['redes']) && $filtros['redes']){
									foreach ($filtros['redes'] as $key => $value) {
										echo "<option value='". $key ."' ". (isset($_GET['redes']) && $_GET['redes'] == $key ? "selected" : "") .">". $value['nome'] ."</option>";
									}
								}
							?>
						</select>
					</div>
				</form>																				
			</div>
		</div>


	<div class="row">
		<div class="col-md-6">

			<?php $chave_grafico = 1; $var_grafico = $grafico['geral']; ?>
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title"><?php echo $var_grafico['titulo']?></h5>
					<div class="heading-elements">
						<ul class="icons-list">
							<li><a data-action="collapse"></a></li>
							<li><a data-action="close"></a></li>
						</ul>
					</div>
				</div>

				<div class="table-responsive">
					<table class="table table-lg text-nowrap">
						<tbody>
							<tr>
								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-1"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['Cadastro'],0,'','.')?> 
										<small class="text-size-base"> (100%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
											<li>
												<span class="text-muted">Total de cadastros</span>
											</li>
										</ul>
									</div>
								</td>

								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-2"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['Optin'],0,'','.')?>  <small class="text-size-base"> (<?php echo round(($var_grafico['subtitulo']['Optin']/$var_grafico['subtitulo']['Cadastro'])*100,2) ?>%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
		
											<li>
												<span class="text-muted">Total Optin</span>
											</li>
										</ul>
									</div>
								</td>
							</tr>
						</tbody>
					</table>	
				</div>

				<div class="panel-body">
					<div class="chart-container has-scroll">
						<div class="chart has-fixed-height has-minimum-width" id="grafico-<?php echo $chave_grafico?>"></div>
					</div>
				</div>
			</div>
			<script>
			<?php if($var_grafico['grafico_id']){?>
				$funcao = <?php echo $var_grafico['grafico_id']?>;
				$funcao('grafico-<?php echo $chave_grafico?>', <?php echo json_encode($var_grafico)?>);

				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-1", 42);
				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-2", 42);

			<?php } ?>
			</script>



		</div>
		<div class="col-md-6">
			<?php $chave_grafico = 2; $var_grafico = $grafico['vendedores']; ?>
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title"><?php echo $var_grafico['titulo']?></h5>
					<div class="heading-elements">
						<ul class="icons-list">
							<li><a data-action="collapse"></a></li>
							<li><a data-action="close"></a></li>
						</ul>
					</div>
				</div>

				<div class="table-responsive">
					<table class="table table-lg text-nowrap">
						<tbody>
							<tr>
								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-1"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['Cadastro'],0,'','.')?> 
										<small class="text-size-base"> (100%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
											<li>
												<span class="text-muted">Total de vendedores</span>
											</li>
										</ul>
									</div>
								</td>

								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-2"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['Optin'],0,'','.')?>  <small class="text-size-base"> (<?php echo round(($var_grafico['subtitulo']['Optin']/$var_grafico['subtitulo']['Cadastro'])*100,2) ?>%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
		
											<li>
												<span class="text-muted">Total Optin</span>
											</li>
										</ul>
									</div>
								</td>
							</tr>
						</tbody>
					</table>	
				</div>

				<div class="panel-body">
					<div class="chart-container has-scroll">
						<div class="chart has-fixed-height has-minimum-width" id="grafico-<?php echo $chave_grafico?>"></div>
					</div>
				</div>
			</div>
			<script>
			<?php if($var_grafico['grafico_id']){?>
				$funcao = <?php echo $var_grafico['grafico_id']?>;
				$funcao('grafico-<?php echo $chave_grafico?>', <?php echo json_encode($var_grafico)?>);

				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-1", 42);
				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-2", 42);

			<?php } ?>
			</script>
		</div>



		<div class="col-md-6">
			<?php $chave_grafico = 3; $var_grafico = $grafico['gerentes']; ?>
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title"><?php echo $var_grafico['titulo']?></h5>
					<div class="heading-elements">
						<ul class="icons-list">
							<li><a data-action="collapse"></a></li>
							<li><a data-action="close"></a></li>
						</ul>
					</div>
				</div>

				<div class="table-responsive">
					<table class="table table-lg text-nowrap">
						<tbody>
							<tr>
								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-1"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['Cadastro'],0,'','.')?> 
										<small class="text-size-base"> (100%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
											<li>
												<span class="text-muted">Total de gerentes</span>
											</li>
										</ul>
									</div>
								</td>

								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-2"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['Optin'],0,'','.')?>  <small class="text-size-base"> (<?php echo round(($var_grafico['subtitulo']['Optin']/$var_grafico['subtitulo']['Cadastro'])*100,2) ?>%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
		
											<li>
												<span class="text-muted">Total Optin</span>
											</li>
										</ul>
									</div>
								</td>
							</tr>
						</tbody>
					</table>	
				</div>

				<div class="panel-body">
					<div class="chart-container has-scroll">
						<div class="chart has-fixed-height has-minimum-width" id="grafico-<?php echo $chave_grafico?>"></div>
					</div>
				</div>
			</div>
			<script>
			<?php if($var_grafico['grafico_id']){?>
				$funcao = <?php echo $var_grafico['grafico_id']?>;
				$funcao('grafico-<?php echo $chave_grafico?>', <?php echo json_encode($var_grafico)?>);

				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-1", 42);
				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-2", 42);

			<?php } ?>
			</script>
		</div>


		<div class="col-md-6">
			<?php $chave_grafico = 4; $var_grafico = $grafico['supervisores']; ?>
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title"><?php echo $var_grafico['titulo']?></h5>
					<div class="heading-elements">
						<ul class="icons-list">
							<li><a data-action="collapse"></a></li>
							<li><a data-action="close"></a></li>
						</ul>
					</div>
				</div>

				<div class="table-responsive">
					<table class="table table-lg text-nowrap">
						<tbody>
							<tr>
								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-1"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['Cadastro'],0,'','.')?> 
										<small class="text-size-base"> (100%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
											<li>
												<span class="text-muted">Total de supervisores</span>
											</li>
										</ul>
									</div>
								</td>

								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-2"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['Optin'],0,'','.')?>  <small class="text-size-base"> (<?php echo round(($var_grafico['subtitulo']['Optin']/$var_grafico['subtitulo']['Cadastro'])*100,2) ?>%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
		
											<li>
												<span class="text-muted">Total Optin</span>
											</li>
										</ul>
									</div>
								</td>
							</tr>
						</tbody>
					</table>	
				</div>

				<div class="panel-body">
					<div class="chart-container has-scroll">
						<div class="chart has-fixed-height has-minimum-width" id="grafico-<?php echo $chave_grafico?>"></div>
					</div>
				</div>
			</div>
			<script>
			<?php if($var_grafico['grafico_id']){?>
				$funcao = <?php echo $var_grafico['grafico_id']?>;
				$funcao('grafico-<?php echo $chave_grafico?>', <?php echo json_encode($var_grafico)?>);

				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-1", 42);
				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-2", 42);

			<?php } ?>
			</script>
		</div>


		<div class="col-md-6">
			<?php $chave_grafico = 5; $var_grafico = $grafico['coordenadores']; ?>
			<div class="panel panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title"><?php echo $var_grafico['titulo']?></h5>
					<div class="heading-elements">
						<ul class="icons-list">
							<li><a data-action="collapse"></a></li>
							<li><a data-action="close"></a></li>
						</ul>
					</div>
				</div>

				<div class="table-responsive">
					<table class="table table-lg text-nowrap">
						<tbody>
							<tr>
								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-1"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['Cadastro'],0,'','.')?> 
										<small class="text-size-base"> (100%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
											<li>
												<span class="text-muted">Total de coordenadores</span>
											</li>
										</ul>
									</div>
								</td>

								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-2"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['Optin'],0,'','.')?>  <small class="text-size-base"> (<?php echo round(($var_grafico['subtitulo']['Optin']/$var_grafico['subtitulo']['Cadastro'])*100,2) ?>%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
		
											<li>
												<span class="text-muted">Total Optin</span>
											</li>
										</ul>
									</div>
								</td>
							</tr>
						</tbody>
					</table>	
				</div>

				<div class="panel-body">
					<div class="chart-container has-scroll">
						<div class="chart has-fixed-height has-minimum-width" id="grafico-<?php echo $chave_grafico?>"></div>
					</div>
				</div>
			</div>
			<script>
			<?php if($var_grafico['grafico_id']){?>
				$funcao = <?php echo $var_grafico['grafico_id']?>;
				$funcao('grafico-<?php echo $chave_grafico?>', <?php echo json_encode($var_grafico)?>);

				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-1", 42);
				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-2", 42);

			<?php } ?>
			</script>
		</div>



	</div>


</div>
<!-- /page header -->




<?php require_once('footer.php'); ?>

