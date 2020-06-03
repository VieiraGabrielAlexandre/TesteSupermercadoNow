<?php global $config;?>

<?php
// ANALYTICS REALTIME

// require_once '../Google/Client.php';
// require_once '../Google/Service/Analytics.php';

// $CLIENT_ID = 'crypto-moon-123015.apps.googleusercontent.com';
// $CLIENT_EMAIL = 'crypto-moon-123015@appspot.gserviceaccount.com';
// $SCOPE = 'https://www.googleapis.com/auth/analytics.readonly';
// $KEY_FILE = '../analytics/key.p12';
// $GA_VIEW_ID = 'ga:147999262';

// $client = new Google_Client();
// $client->setClientId($CLIENT_ID);
// $client->setAssertionCredentials(
//     new Google_Auth_AssertionCredentials(
//         $CLIENT_EMAIL,
//         array($SCOPE),
//         file_get_contents($KEY_FILE)
//     )
// );

// $service = new Google_Service_Analytics($client);
// try {
//     $result = $service->data_realtime->get(
//         $GA_VIEW_ID,
//         'rt:activeVisitors'
//     );
//     var_dump($result->totalsForAllResults['rt:activeVisitors']);
// } catch(Exception $e) {
//     var_dump($e);
// }
// exit;
?>

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

	<div class="row">
		<div class="col-md-6">

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
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['OptIn'],0,'','.')?>  <small class="text-size-base"> (<?php echo round(($var_grafico['subtitulo']['OptIn']/$var_grafico['subtitulo']['Cadastro'])*100,2) ?>%)</small></h5>
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

				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-1", 42, 4);
				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-2", 42, 4);

			<?php } ?>
			</script>

		</div>


		<div class="col-md-6">

			<?php $chave_grafico++; $var_grafico = $grafico['grafico2']; ?>
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
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['OptIn'],0,'','.')?>  <small class="text-size-base"> (<?php echo round(($var_grafico['subtitulo']['OptIn']/$var_grafico['subtitulo']['Cadastro'])*100,2) ?>%)</small></h5>
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

				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-1", 42, 4);
				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-2", 42, 4);

			<?php } ?>
			</script>

		</div>


		<div class="col-md-6">

			<?php $chave_grafico++; $var_grafico = $grafico['grafico3']; ?>
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
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['OptIn'],0,'','.')?>  <small class="text-size-base"> (<?php echo round(($var_grafico['subtitulo']['OptIn']/$var_grafico['subtitulo']['Cadastro'])*100,2) ?>%)</small></h5>
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

				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-1", 42, 4);
				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-2", 42, 4);

			<?php } ?>
			</script>

		</div>


		<div class="col-md-6">

			<?php $chave_grafico++; $var_grafico = $grafico['grafico4']; ?>
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
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['OptIn'],0,'','.')?>  <small class="text-size-base"> (<?php echo round(($var_grafico['subtitulo']['OptIn']/$var_grafico['subtitulo']['Cadastro'])*100,2) ?>%)</small></h5>
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

				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-1", 42, 4);
				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-2", 42, 4);

			<?php } ?>
			</script>

		</div>


		<div class="col-md-6">

			<?php $chave_grafico++; $var_grafico = $grafico['grafico5']; ?>
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
										<h5 class="text-semibold no-margin"><?php echo number_format($var_grafico['subtitulo']['OptIn'],0,'','.')?>  <small class="text-size-base"> (<?php echo round(($var_grafico['subtitulo']['OptIn']/$var_grafico['subtitulo']['Cadastro'])*100,2) ?>%)</small></h5>
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

				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-1", 42, 4);
				campaignDonut("#geral-subtitulo-<?php echo $chave_grafico?>-2", 42, 4);

			<?php } ?>
			</script>

		</div>





	</div>


</div>
<!-- /page header -->




<?php require_once('footer.php'); ?>

