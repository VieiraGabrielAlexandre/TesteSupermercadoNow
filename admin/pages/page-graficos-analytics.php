<?php global $config;?>
<?php require_once('header.php'); ?>

<!-- Page header -->
<div class="page-header page-header-default">

</div>
<!-- /page header -->

<div class="content">

	<div class="row">

		
		<div class="col-md-12">

			<?php $chave_grafico++; $var_grafico = $grafico['grafico-analytics-pageviews']; ?>
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
							<!-- <tr>
								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-1"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['lojas'],0,'','.')?> 
										<small class="text-size-base"> (100%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
											<li>
												<span class="text-muted">Total de pageviews no mês</span>
											</li>
										</ul>
									</div>
								</td>

								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-2"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['lojas_ativo'],0,'','.')?>  <small class="text-size-base"> (<?php echo round(100 * $var_grafico['subtitulo']['lojas_ativo'] / $var_grafico['subtitulo']['lojas'],2) ?>%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
		
											<li>
												<span class="text-muted">Total de distribuidoras ativas</span>
											</li>
										</ul>
									</div>
								</td>
							</tr> -->
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



		<div class="col-md-12">

			<?php $chave_grafico++; $var_grafico = $grafico['grafico-analytics-visits']; ?>
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
							<!-- <tr>
								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-1"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['lojas'],0,'','.')?> 
										<small class="text-size-base"> (100%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
											<li>
												<span class="text-muted">Total de pageviews no mês</span>
											</li>
										</ul>
									</div>
								</td>

								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-2"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['lojas_ativo'],0,'','.')?>  <small class="text-size-base"> (<?php echo round(100 * $var_grafico['subtitulo']['lojas_ativo'] / $var_grafico['subtitulo']['lojas'],2) ?>%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
		
											<li>
												<span class="text-muted">Total de distribuidoras ativas</span>
											</li>
										</ul>
									</div>
								</td>
							</tr> -->
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



		<div class="col-md-12">

			<?php $chave_grafico++; $var_grafico = $grafico['grafico-analytics-avgSessionDuration']; ?>
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
							<!-- <tr>
								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-1"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['lojas'],0,'','.')?> 
										<small class="text-size-base"> (100%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
											<li>
												<span class="text-muted">Total de pageviews no mês</span>
											</li>
										</ul>
									</div>
								</td>

								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-2"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['lojas_ativo'],0,'','.')?>  <small class="text-size-base"> (<?php echo round(100 * $var_grafico['subtitulo']['lojas_ativo'] / $var_grafico['subtitulo']['lojas'],2) ?>%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
		
											<li>
												<span class="text-muted">Total de distribuidoras ativas</span>
											</li>
										</ul>
									</div>
								</td>
							</tr> -->
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



		<div class="col-md-12">

			<?php $chave_grafico++; $var_grafico = $grafico['grafico-analytics-pageviewsPerSession']; ?>
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
							<!-- <tr>
								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-1"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['lojas'],0,'','.')?> 
										<small class="text-size-base"> (100%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
											<li>
												<span class="text-muted">Total de pageviews no mês</span>
											</li>
										</ul>
									</div>
								</td>

								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-2"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['lojas_ativo'],0,'','.')?>  <small class="text-size-base"> (<?php echo round(100 * $var_grafico['subtitulo']['lojas_ativo'] / $var_grafico['subtitulo']['lojas'],2) ?>%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
		
											<li>
												<span class="text-muted">Total de distribuidoras ativas</span>
											</li>
										</ul>
									</div>
								</td>
							</tr> -->
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


		<div class="col-md-12">

			<?php $chave_grafico++; $var_grafico = $grafico['grafico-analytics-mostvisits']; ?>
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
							<!-- <tr>
								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-1"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['lojas'],0,'','.')?> 
										<small class="text-size-base"> (100%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
											<li>
												<span class="text-muted">Total de pageviews no mês</span>
											</li>
										</ul>
									</div>
								</td>

								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-2"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['lojas_ativo'],0,'','.')?>  <small class="text-size-base"> (<?php echo round(100 * $var_grafico['subtitulo']['lojas_ativo'] / $var_grafico['subtitulo']['lojas'],2) ?>%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
		
											<li>
												<span class="text-muted">Total de distribuidoras ativas</span>
											</li>
										</ul>
									</div>
								</td>
							</tr> -->
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


		<div class="col-md-12">

			<?php $chave_grafico++; $var_grafico = $grafico['grafico-analytics-ativos15dias']; ?>
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
							<!-- <tr>
								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-1"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['lojas'],0,'','.')?> 
										<small class="text-size-base"> (100%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
											<li>
												<span class="text-muted">Total de pageviews no mês</span>
											</li>
										</ul>
									</div>
								</td>

								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-2"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['lojas_ativo'],0,'','.')?>  <small class="text-size-base"> (<?php echo round(100 * $var_grafico['subtitulo']['lojas_ativo'] / $var_grafico['subtitulo']['lojas'],2) ?>%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
		
											<li>
												<span class="text-muted">Total de distribuidoras ativas</span>
											</li>
										</ul>
									</div>
								</td>
							</tr> -->
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
