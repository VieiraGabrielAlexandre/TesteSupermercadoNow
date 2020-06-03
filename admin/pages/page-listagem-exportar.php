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

<div class="content" style="padding:0px 11px 11px 11px;">
	<div class="col-xs-11"></div>
	<div class="col-xs-1">
		<a href="<?php echo isset($exportar)&&$exportar?$exportar:'?exportar';?>" class="btn btn-default btn-block btn-float btn-float-lg">
			<i class="fa fa-save text-green"></i>
			<span><?php echo isset($exportar_title)&&$exportar_title?$exportar_title:'Exportar';?></span>
		</a>
	</div>
</div>


<div class="content">
	
	<?php if(isset($_GET['alerta-sucesso'])){?>
	<div class="alert bg-success">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Fechar</span></button>
		<?php if($_GET['alerta-sucesso']){
			echo $_GET['alerta-sucesso'];
		}else{ ?>
			Dados salvos com sucesso.
		<?php } ?>
	</div>
	<?php } ?>
	
	<?php if(isset($_GET['alerta-erro'])){?>
	<div class="alert bg-danger">
		<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Fechar</span></button>
		<?php if($_GET['alerta-erro']){
			echo $_GET['alerta-erro'];
		}else{ ?>
			Não foi possível salvar os dados.
		<?php } ?>
	</div>
	<?php } ?>

	<?php if(isset($exportar) && $exportar && is_array($exportar)){?>
	<h4><span class="text-semibold"></span></h4>
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title">Filtros para exportar<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
					<li><a data-action="close"></a></li>
				</ul>
			</div>
		</div>
		<div class="panel-body">
			<form method="get" id="filter" name="filter" target="_blank">
				<input type="hidden" value="exportar" name="type" />
				<?php foreach($exportar as $name => $campo){?>
				<div class="col-md-<?php echo (12/(count($exportar)+1));?>">
					<label><?php echo $campo['title'];?></label>
					<select name="<?php echo $name;?>" class="form-control">
						<option value=""></option>							
						<?php 
							foreach ($campo['values'] as $key => $value) {
								echo "<option value='". $key ."'>". $value ."</option>";
							}
						?>
					</select>
				</div>
				<?php } ?>
				<div class="col-md-<?php echo (12/(count($exportar)+1));?>">
					<label style="float:right;">&nbsp;</label>
					<button class="btn bg-success" type="submit" style="display:block;width:50%;float:right;clear:both;">Exportar</button>
				</div>
			</form>																				
		</div>
	</div>
	<?php } ?>

	<div class="panel panel-flat" style="display:<?php echo $grid['config']['show-search-get']?'block':'none';?>;">
		<div class="panel-body">
			<form class="form-group" method="get" style="margin:0;">
				<div class="col-lg-10">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Busca" name="b" value="<?php echo $_GET['b'];?>">
						<span class="input-group-btn">
							<button class="btn bg-teal" type="button" onClick="$(this).closest('form').submit();">Buscar</button>
						</span>
					</div>
				</div>
			</form method="get">
		</div>
	</div>
<script>
var pagination_default = <?php echo $grid['config']['pagination-default']?$grid['config']['pagination-default']:50;?>;
var order_colum = <?php echo $grid['config']['order-colum']?$grid['config']['order-colum']:0;?>;
var order_by = '<?php echo $grid['config']['order-by']?$grid['config']['order-by']:'ASC';?>';
var show_search = <?php echo $grid['config']['show-search']?$grid['config']['show-search']:'false';?>;
var show_pagination = <?php echo $grid['config']['show-pagination']?$grid['config']['show-pagination']:'false';?>;
var no_order = <?php echo $grid['config']['no-order']?$grid['config']['no-order']:'false';?>;
var no_header = <?php echo $grid['config']['no-header']?'true':'false';?>;
var no_footer = <?php echo $grid['config']['no-footer']?'true':'false';?>;
var no_grid = <?php echo $grid['config']['no-grid']?'true':'false';?>;
var no_filter = <?php echo $grid['config']['no-filter']?'true':'false';?>;
</script>

	<?php $tb_footer = array();?>
	<div class="panel panel-flat">
		<table class="table datatable-button-init-basic">
			<thead>
				<tr>
					<?php foreach ($grid['titles'] as $key => $value) {
						echo "<th>".$value."</th>";
						$tb_footer[] = 1;
					}?>
									<?php if(!isset($grid['config']['no-actions'])){ ?>
                <th class="text-center">Ação</th>
                <?php } ?>
	            </tr>
			</thead>
			<tbody>
				<?php 
					if(isset($grid['items']) && $grid['items']){
						foreach ($grid['items'] as $key => $v) {
							echo '<tr '.(isset($grid['command'][$key]) && $grid['command'][$key] ? $grid['command'][$key] : '').' ">';
							foreach ($v as $col => $value) {
								
								if(isset($col) && $col && $col == "buttonsGrid"){
									if(count($value) == 1){
										$bt = array_shift($value);
										if(isset($bt['url']))
											echo '<td class="text-center"><a '.$bt['command'].' href="'.$bt['url'].'"><i class="'.$bt['icon'].'"></i> '.$bt['title'].'</a></td>';

									} else if(count($value) > 1){
										echo '<td class="text-center">
											<ul class="icons-list">
												<li class="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
														<i class="icon-menu9"></i>
													</a>
													<ul class="dropdown-menu dropdown-menu-right">';
										foreach ($value as $b => $bt) {
											if(isset($bt['url']))
												echo '<li><a '.$bt['command'].' href="'.$bt['url'].'"><i class="'.$bt['icon'].'"></i> '.$bt['title'].'</a></li>';
										}

										echo '</ul>
												</li>
											</ul>
										</td>';
									}else{
										echo '<td></td>';
									}
									continue;
								}
								$_col = is_array($value[1])?$value[1][0]:$col;
								$_value = is_array($value[1])?$value[1][1]:$value[1];

								if($col == 'data-order' && $col)
									echo '<td data-order="'.$value[0].'">'.formata_valor($_col, $_value).'</td>';
								else if($col == 'data-search' && $col)
									if($grid['config']['show-search'])
										echo '<td data-search="'.$value[0].'">'.formata_valor($_col, $_value).'</td>';
									else
										echo '<td>'.formata_valor($_col, $_value).'</td>';
								else
									echo '<td>'.formata_valor($col, $value).'</td>';
							}
							echo '</tr>';
				?>

				<?php }} ?>

			</tbody>
			<tfoot>
				<tr>
	                <?php foreach($tb_footer as $f)
	                	echo '<td></td>'; ?>
	            </tr>
			</tfoot>
		</table>
	</div>
	

</div>
<!-- /page header -->

<?php if(isset($grid['modal']) && $grid['modal']){ ?>
	<?php foreach($grid['modal'] as $key => $v){ ?>
		<div id="modal-<?php echo $key;?>" class="modal fade">
			<div class="modal-dialog <?php echo $v['class']?$v['class']:'';?>" <?php echo $v['command']?$v['command']:'';?>>
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<?php if(isset($v['title']) && $v['title']){?>
						<h5 class="modal-title"><?php echo $v['title'];?></h5>
						<?php } ?>
					</div>
					<div class="modal-body">
						<iframe src="" style="border:none;width:100%;height:600px;"></iframe>
					<?php if(isset($v['text']) && $v['text']){?>
						<?php echo $v['text'];?>
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
<?php } ?>

<?php require_once('footer.php'); ?>

