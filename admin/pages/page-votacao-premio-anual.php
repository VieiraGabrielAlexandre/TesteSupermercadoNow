
<?php require_once('header.php'); global $meses; ?>

<!-- Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><span class="text-semibold">Votação Prêmio Anual</span></h4>
			<a class="heading-elements-toggle"><i class="icon-more"></i></a>
		</div>

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


		<div class="col-md-6">
			<h2 style="margin-top:0;">Distribuidoras</h2>

			<?php $chave_grafico++; $var_grafico = $grafico['votacao']; ?>
			<div class="panel panel-flat">

				<div class="table-responsive">
					<table class="table table-lg text-nowrap">
						<tbody>
							<tr>
								<td class="col-md-5" style="border:0;">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-1"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['votos'],0,'','.')?> 
										<small class="text-size-base"> (100%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
											<li>
												<span class="text-muted">Total de votos</span>
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

		<div class="col-sm-6 col-lg-3">
			<h2 style="margin-top:0;visibility:hidden;">Distribuidoras</h2>

			<div class="panel panel-default">

				<div class="panel panel-body" style="margin:0;border:none;">
					<div class="row text-center">
						<div class="col-xs-4">
							<h5 style="font-size:32px;" class="text-semibold no-margin"><?php echo $votos['cultural'];?></h5>
							<span class="text-muted text-size-small">Cultural</span>
						</div>

						<div class="col-xs-4">
							<h5 style="font-size:32px;" class="text-semibold no-margin"><?php echo $votos['gastronomico'];?></h5>
							<span class="text-muted text-size-small">Gastronômico</span>
						</div>

						<div class="col-xs-4">
							<h5 style="font-size:32px;" class="text-semibold no-margin"><?php echo $votos['aventura'];?></h5>
							<span class="text-muted text-size-small">Aventura</span>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>


	<div class="row">


		<div class="col-md-6">
			<h2 style="margin-top:10px;">Doceiros</h2>

			<?php $chave_grafico++; $var_grafico = $grafico['votacao-doceiros']; ?>
			<div class="panel panel-flat">

				<div class="table-responsive">
					<table class="table table-lg text-nowrap">
						<tbody>
							<tr>
								<td class="col-md-5" style="border:0;">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-1"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['votos'],0,'','.')?> 
										<small class="text-size-base"> (100%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
											<li>
												<span class="text-muted">Total de votos</span>
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

		<div class="col-sm-3 col-lg-3">
			<h2 style="margin-top:10px;visibility:hidden;">Doceiros</h2>

			<div class="panel panel-default">

				<div class="panel panel-body" style="margin:0;border:none;">
					<div class="row text-center">
						<div class="col-xs-6">
							<h5 style="font-size:32px;" class="text-semibold no-margin"><?php echo $votos_doceiros['classico'];?></h5>
							<span class="text-muted text-size-small">Clássico</span>
						</div>

						<div class="col-xs-6">
							<h5 style="font-size:32px;" class="text-semibold no-margin"><?php echo $votos_doceiros['exotico'];?></h5>
							<span class="text-muted text-size-small">Exótico</span>
						</div>

					</div>
				</div>

			</div>

		</div>

	</div>


</div>
<!-- /page header -->

<?php require_once('footer.php'); ?>

