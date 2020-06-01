<?php 
	global $config;

?>
<!DOCTYPE html>
<html data-wf-site="5697bc39b20330de747477a7" data-wf-page="5697f983d9729c455c792b31">
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<meta property="og:title" content="Login">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="generator" content="Webflow">
	<link rel="stylesheet" type="text/css" href="<?php echo $config['static_baseurl']?>/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $config['static_baseurl']?>/css/webflow.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $config['static_baseurl']?>/css/site.webflow.css">
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
	<script type="text/javascript" src="<?php echo $config['static_baseurl']?>/js/jquery.1.11.min.js"></script>

	<script>
		WebFont.load({
			google: {
				families: ["Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic","Open Sans Condensed:300,300italic,700"]
			}
		});
	</script>
	<script type="text/javascript" src="<?php echo $config['static_baseurl']?>/js/modernizr.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $config['static_baseurl']?>/images/fav.png">
	<link rel="apple-touch-icon" href="<?php echo $config['static_baseurl']?>/images/webclip.jpg">
	<style>
		input[type=checkbox]:checked + label {
			opacity: 1;
		}
		input[type=radio]:checked + label {
			opacity: 1;
		}
		.w-select {
			background-image: none !important;
		}
	</style>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', '<?php echo $config['analytics'];?>', 'auto');
		ga('send', 'pageview');
	</script>
</head>
<body>

	<?php echo $body?>

	<script type="text/javascript" src="<?php echo $config['static_baseurl']?>/js/maskedinput.min.js"></script>
	<script type="text/javascript" src="<?php echo $config['static_baseurl']?>/js/jquery.price_format.2.0.min.js"></script>
	<script type="text/javascript" src="<?php echo $config['static_baseurl']?>/js/core.js"></script>
	<script type="text/javascript" src="<?php echo $config['static_baseurl']?>/js/webflow.js"></script>


	<!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
</body>
</html>