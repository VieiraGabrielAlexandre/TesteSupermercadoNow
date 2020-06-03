<?php 
	global $config;
	global $template_default_vars;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $template_default_vars['page_title'];?></title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo $config['baseurl_admin']?>/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $config['baseurl_admin']?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $config['baseurl_admin']?>/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $config['baseurl_admin']?>/assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $config['baseurl_admin']?>/assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->


	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/core/app.js"></script>
	<!-- /theme JS files -->

	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/core/data-ajax.js"></script>
	<script>
	CONFIG.baseurl = '<?php echo $config['baseurl_admin'];?>';
	</script>

	<style>
	*:not(h4){
		font-size:12px!important;
	}
	*{
/* text-transform: uppercase */
	}
	</style>

</head>

<body class="login-container">


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<?php echo $body?>

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
