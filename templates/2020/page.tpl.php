<?php 
	global $config;
	$user = get_logged_user();
?>
<!DOCTYPE html>
<html data-wf-site="5697bc39b20330de747477a7" data-wf-page="5697f983d9729c455c792b31">
<head>
	<meta charset="utf-8">
	<title><?php echo $page_title?></title>
	<meta property="og:title" content="Login">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?php echo $config['static_baseurl']?>/css/normalize.css">
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
	<script type="text/javascript" src="<?php echo $config['static_baseurl']?>/js/jquery.1.11.min.js"></script>

	<script>
		WebFont.load({
			google: {
				families: ["Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic","Open Sans Condensed:300,300italic,700"]
			}
		});
	</script>
</head>
<body>

	<!-- HEADER -->

	<?php echo $body?>

	<!-- FOOTER -->
	<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

	<script type="text/javascript" src="<?php echo $config['static_baseurl']?>/js/maskedinput.min.js"></script>
	<script type="text/javascript" src="<?php echo $config['static_baseurl']?>/js/jquery.price_format.2.0.min.js"></script>
	<script type="text/javascript" src="<?php echo $config['static_baseurl']?>/js/core.js"></script>
	<!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
</body>
</html>