<?php require_once('header.php'); ?>
<!-- Page header -->
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><span class="text-semibold">Chat:</span></h4><br>
			<h6><span class="text-semibold">
					<?php echo nl2br($conversa['notas']);?><br>
		      		Tipo: <?php echo $conversa['tipo'];?><br>
					Nome: <?php echo $conversa['nome'];?>
				</span>
			</h6>
			<a class="heading-elements-toggle"><i class="icon-more"></i></a>
		</div>
	</div>
</div>

<div class="content">
	<div class="row">
		<div class="col-lg-9">
			<!-- Messages -->
			<div class="timeline-row">
				<div class="panel panel-flat timeline-content">

					<div class="panel-body">
						<ul class="media-list chat-list content-group">
							<li class="media date-step">
								<span>Conversa com <?php echo $conversa['nome'];?></span>
							</li>
							<?php
								if(isset($conversa['historico']) && $conversa['historico']){
									foreach($conversa['historico'] as $key => $msg){
							?>

							<?php if($msg['de'] == "eu"){?>
							<li class="media reversed">
								<div class="media-body">
									<div class="media-content"><?php echo $msg['msg'];?></div>
									<span class="media-annotation display-block mt-10"> <?php echo date('d/m/Y H:i:s',strtotime($msg['timestamp']));?> <a href="#"><i class="icon-calendar3 position-right text-muted"></i></a></span>
								</div>

								<div class="media-right">
									<a href="#" onClick="return false;">
										<img src="<?php echo $config['static_baseurl']?>/images/webclip.jpg" class="img-circle" alt="">
									</a>
								</div>
							</li>
							<?php } ?>

							<?php if($msg['de'] == "ele"){?>
							<li class="media">
								<div class="media-left">
									<a href="#" onClick="return false;">
										<img src="<?php echo $config['static_baseurl'].'/images/avatar.jpg';?>" class="img-circle" alt="">
									</a>
								</div>

								<div class="media-body">
									<div class="media-content"><?php echo $msg['msg'];?></div>
									<span class="media-annotation display-block mt-10"> <?php echo date('d/m/Y H:i:s',strtotime($msg['timestamp']));?> <a href="#"><i class="icon-calendar3 position-right text-muted"></i></a></span>
								</div>
							</li>
							<?php } ?>


							<?php
									}
								}
							?>

						</ul>

					</div>
				</div>
			</div>
			<!-- /messages -->
		</div>
	</div>
</div>

<?php require_once('footer.php'); ?>