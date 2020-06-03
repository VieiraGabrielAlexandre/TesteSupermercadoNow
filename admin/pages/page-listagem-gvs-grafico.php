<?php require_once('header.php'); ?>

<!-- Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><span class="text-semibold">Diretoria <?php echo $diretoria;?></span></h4>
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

		<div class="col-md-12">

			<?php $chave_grafico++; $var_grafico = $grafico['grafico1']; ?>
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
										<h5 class="text-semibold no-margin"><?php echo $var_grafico['subtitulo']['acessos']?> 
										<small class="text-size-base"> (100%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
											<li>
												<span class="text-muted">Total de acessos</span>
											</li>
										</ul>
									</div>
								</td>

								<td class="col-md-5">
									<div class="media-left">
										<div id="geral-subtitulo-<?php echo $chave_grafico?>-2"></div>
									</div>

									<div class="media-left">
										<h5 class="text-semibold no-margin"><?php echo $var_grafico['subtitulo']['ultimos_15']?>  <small class="text-size-base"> (<?php echo round(($var_grafico['subtitulo']['ultimos_15']/$var_grafico['subtitulo']['acessos'])*100,2) ?>%)</small></h5>
										<ul class="list-inline list-inline-condensed no-margin">
		
											<li>
												<span class="text-muted">Total de GVs que acessaram nos últimos 15 dias</span>
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

<?php if($diretoria != 'DOCEIRO' && $diretoria != 'ATACADO'){?>


<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><span class="text-semibold">GVs Diretoria <?php echo $diretoria;?></span></h4>
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

		<?php foreach($distribuidores_x_pdvs as $gv => $dados){ ?>
		<div class="col-md-12">

			<?php $chave_grafico++; $var_grafico = $graficos_dist[$gv]; ?>
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
		<?php } ?>

	</div>

</div>

<?php } ?>

<?php require_once('footer.php'); ?>

