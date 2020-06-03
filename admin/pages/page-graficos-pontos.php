<?php global $config;?>
<?php require_once('header.php'); ?>

<!-- Page header -->
<div class="page-header page-header-default">

</div>
<!-- /page header -->

<div class="content">

	<h4><span class="text-semibold">Filtros</span></h4>
	<div class="panel panel-flat">
		<div class="panel-body">

			<form method="get" id="filter" name="filter">
				<div class="col-md-3">

					<label>Estado</label>
					<select name="estados" onchange="this.form.submit();" class="form-control">
						<option value=""></option>							
						<?php 

							if(isset($filtros['estados']) && $filtros['estados']){
								foreach ($filtros['estados'] as $key => $value) {
									echo "<option value='". $key ."' ". (isset($_GET['estados']) && $_GET['estados'] == $key ? "selected" : "") .">". $key ."</option>";
								}
							}
						?>						
					</select>
				</div>

				<div class="col-md-3">

					<label>Quarter</label>
					<select name="quarter" onchange="this.form.submit();" class="form-control">
						<option value=""></option>							
						<?php 
							$quarters = get_quarters();
							if(isset($filtros['quarters']) && $filtros['quarters']){
								foreach($filtros['quarters'] as $key => $value){
									echo "<option value='". $key ."' ". (isset($_GET['quarter']) && $_GET['quarter'] == $key ? "selected" : "") .">". utf8_encode($value['titulo']) ."</option>";
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

			<?php $chave_grafico++; $var_grafico = $grafico['grafico-pontos-empresas']; ?>
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
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['pontos'],0,'','.')?> 
										<small class="text-size-base"> (100%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
											<li>
												<span class="text-muted">Total de pontos</span>
											</li>
										</ul>
									</div>
								</td>

								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-2"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['lojas_com_ponto'],0,'','.')?>  <small class="text-size-base"> (<?php echo round(100 * $var_grafico['subtitulo']['lojas_com_ponto'] / $var_grafico['subtitulo']['lojas_ativas'],2) ?>%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
		
											<li>
												<span class="text-muted">Lojas com ponto</span>
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

				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-1", 42, 4);
				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-2", 42, 4);

			<?php } ?>
			</script>

		</div>


		<div class="col-md-6">

			<?php $chave_grafico++; $var_grafico = $grafico['grafico-pontos-mensal']; ?>
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
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['pontos'],0,'','.')?> 
										<small class="text-size-base"> (100%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
											<li>
												<span class="text-muted">Total de pontos</span>
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

				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-1", 42, 4);
				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-2", 42, 4);

			<?php } ?>
			</script>

		</div>

	</div>

	<div class="row">


		<div class="col-md-6">

			<?php $chave_grafico++; $var_grafico = $grafico['grafico-pontos-perfil']; ?>
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
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['pontos'],0,'','.')?> 
										<small class="text-size-base"> (100%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
											<li>
												<span class="text-muted">Total de pontos</span>
											</li>
										</ul>
									</div>
								</td>

								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-2"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['perfil_com_ponto'],0,'','.')?>  <small class="text-size-base"> (<?php echo round(100 * $var_grafico['subtitulo']['perfil_com_ponto'] / $var_grafico['subtitulo']['perfil_ativo'],2) ?>%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
		
											<li>
												<span class="text-muted">Perfis com pontos</span>
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

				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-1", 42, 4);
				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-2", 42, 4);

			<?php } ?>
			</script>

		</div>


	</div>

</div>

<?php require_once('footer.php'); ?>
