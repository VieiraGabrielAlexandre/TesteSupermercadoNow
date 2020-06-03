<?php global $config;?>

<?php $hide_header=true; require_once('header.php'); ?>

<div class="chart-container">
	<div class="chart has-minimum-width" id="grafico-arvore"></div>
</div>
<script>
graficoArvore('grafico-arvore', <?php echo json_encode($grafico,1);?>);
</script>

<?php require_once('footer.php'); ?>

