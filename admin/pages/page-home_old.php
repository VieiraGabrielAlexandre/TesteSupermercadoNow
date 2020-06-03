<?php global $config, $estados;?>
<?php require_once('header.php'); ?>

<!-- Page header -->
<div class="page-header page-header-default">
</div>


<!-- /page header -->

<div class="content">

	<?php $i = 0; $chave_grafico = 0; $abriu = false; if($grafico['grafico-ativacao']){ ?>
		<?php foreach($grafico['grafico-ativacao'] as $tipo => $var_grafico){ if($i==2)$i=0; $i++; $chave_grafico++; ?>

			<?php if($i==1){ $abriu = true; ?>
			<div class="row">
			<?php } ?>
				<div class="col-md-6">

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
												<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['total'],0,'','.')?> 
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
												<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['ativo'],0,'','.')?>  <small class="text-size-base"> (<?php echo round(($var_grafico['subtitulo']['ativo']/$var_grafico['subtitulo']['total'])*100,2) ?>%)</small></h5>
												<ul class="list-inline list-inline-condensed no-margin">
				
													<li>
														<span class="text-muted">Total ativo</span>
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
			<?php if($i==2){ $abriu = false; ?>
			</div>
			<?php } ?>

		<?php } ?>

		<?php if($abriu){ ?>
		</div>
		<?php } ?>

	<?php } ?>


	<div class="panel">
		<div class="panel-heading" >
			<h1 class="panel-title text-left" style="min-height:42px;line-height:42px;padding-left:0;font-size:20px!important;">&nbsp;Acessos</h1>
		</div>
		<hr style="margin:0"/>

		<div class="row">

		
			<div class="col-md-6">

				<?php $chave_grafico++; $var_grafico = $grafico['grafico-analytics-pageviews']; ?>
				<div class="panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?php echo $var_grafico['titulo']?></h5>
					</div>

					<div class="table-responsive" style="height:1px;">
						<table class="table table-lg text-nowrap">
							<tbody>
								<tr>
									<td class="col-md-5">
										<div class="media-left">
											<div id="geral-subtitulo-<?php echo $chave_grafico?>-1"></div>
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

				<?php } ?>
				</script>

			</div>

			<div class="col-md-6">

				<?php $chave_grafico++; $var_grafico = $grafico['grafico-analytics-visits']; ?>
				<div class=" panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?php echo $var_grafico['titulo']?></h5>
					</div>

					<div class="table-responsive" style="height:1px;">
						<table class="table table-lg text-nowrap">
							<tbody>
								<tr>
									<td class="col-md-5">
										<div class="media-left">
											<div id="geral-subtitulo-<?php echo $chave_grafico?>-1"></div>
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

				<?php } ?>
				</script>

			</div>

		</div>

		<div class="row">



			<div class="col-md-6">

				<?php $chave_grafico++; $var_grafico = $grafico['grafico-analytics-avgSessionDuration']; ?>
				<div class=" panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?php echo $var_grafico['titulo']?></h5>
					</div>
					<div class="table-responsive" style="height:1px;">
						<table class="table table-lg text-nowrap">
							<tbody>
								<tr>
									<td class="col-md-5">
										<div class="media-left">
											<div id="geral-subtitulo-<?php echo $chave_grafico?>-1"></div>
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

				<?php } ?>
				</script>

			</div>


			<div class="col-md-6">

				<?php $chave_grafico++; $var_grafico = $grafico['grafico-analytics-pageviewsPerSession']; ?>
				<div class=" panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title"><?php echo $var_grafico['titulo']?></h5>
					</div>

					<div class="table-responsive" style="height:1px;">
						<table class="table table-lg text-nowrap">
							<tbody>
								<tr>
									<td class="col-md-5">
										<div class="media-left">
											<div id="geral-subtitulo-<?php echo $chave_grafico?>-1"></div>
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

				<?php } ?>
				</script>

			</div>
		</div>
	</div>



<div class="panel">
	<div class="panel-heading" >
		<h1 class="panel-title text-left" style="min-height:42px;line-height:42px;padding-left:0;font-size:20px!important;">&nbsp;Analytics</h1>
	</div>
	<hr style="margin:0"/>

	<div class="row">

		<div class="col-md-6">

			<?php $chave_grafico++; $var_grafico = $grafico['grafico-analytics-mostvisits']; ?>
			<div class="panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title"><?php echo $var_grafico['titulo']?></h5>
				</div>

				<div class="table-responsive">
					<table class="table table-lg text-nowrap">
						<tbody>
							<tr>
								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-1"></div>
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
			<?php } ?>
			</script>

		</div>


		<div class="col-md-6">

			<?php $chave_grafico++; $var_grafico = $grafico['grafico-analytics-ativos15dias']; ?>
			<div class="panel-flat">
				<div class="panel-heading">
					<h5 class="panel-title"><?php echo $var_grafico['titulo']?></h5>
				</div>

				<div class="table-responsive">
					<table class="table table-lg text-nowrap">
						<tbody>
							<tr>
								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-1"></div>
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
			<?php } ?>
			</script>

		</div>


	</div>

</div>

<?php require_once('footer.php'); ?>
