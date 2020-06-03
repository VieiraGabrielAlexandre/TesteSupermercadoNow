<?php global $config;?>
<?php global $template_default_vars; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $template_default_vars['page_title'];?></title>

	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $config['static_baseurl']?>/images/fav.png">
	<link rel="apple-touch-icon" href="<?php echo $config['static_baseurl']?>/images/webclip.jpg">

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo $config['baseurl_admin']?>/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $config['baseurl_admin']?>/assets/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
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
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/pickers/pickadate/picker.js"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/pickers/pickadate/picker.date.js"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/pickers/pickadate/picker.time.js"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/pickers/pickadate/legacy.js"></script>

	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/core/libraries/jasny_bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/forms/inputs/autosize.min.js"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/forms/inputs/formatter.min.js"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/forms/inputs/passy.js"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/forms/inputs/maxlength.min.js"></script>

	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/visualization/d3/d3_tooltip.js?1"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/forms/styling/switch.min.js"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/pickers/daterangepicker.js"></script>

	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/notifications/bootbox.min.js"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/notifications/sweet_alert.min.js"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/tables/datatables/extensions/col_reorder.min.js"></script>
	<!-- <script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script> -->
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/visualization/echarts/echarts.js"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/visualization/sparkline.min.js"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/plugins/media/fancybox.min.js"></script>	
		

	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/core/app.js?<?php echo time();?>"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/pages/dashboard.js?<?php echo time();?>"></script>

	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/pages/components_modals.js?<?php echo time();?>"></script>
	<!-- /theme JS files -->

	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/core/data-ajax.js?<?php echo time();?>"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/core/graficos.js?<?php echo time();?>"></script>
	<script type="text/javascript" src="<?php echo $config['baseurl_admin']?>/assets/js/core/core.js?<?php echo time();?>"></script>
	<script>
	CONFIG.baseurl = '<?php echo $config['baseurl'];?>';
	CONFIG.ajax_path= '<?php echo $_SERVER["REQUEST_URI"];?>';
	</script>

	<script>
		// GRAFICOS EC
		$(function(){
		    require.config({
		        paths: {
		            echarts: '<?php echo $config['baseurl_admin'];?>/assets/js/plugins/visualization/echarts'
		        }
		    });

		    require(
		        [
		            'echarts',
		            'echarts/theme/limitless',
		            'echarts/chart/pie',
		            'echarts/chart/funnel',
		            'echarts/chart/bar',
            		'echarts/chart/line'
		        ],

		        // Charts setup
		        function (ec, limitless) {
		            $(document).trigger('chart.ec',ec,limitless);
		        }

		    );
		});

		var dataMap = {};
		function dataFormatter(obj) {
		    var pList = ['Paris','Budapest','Prague','Madrid','Amsterdam','Berlin','Bratislava','Munich','Hague','Rome','Milan'];
		    var temp;
		    var max = 0;
		    for (var year = 2010; year <= 2014; year++) {
		        temp = obj[year];
		        for (var i = 0, l = temp.length; i < l; i++) {
		            max = Math.max(max, temp[i]);
		            obj[year][i] = {
		                name : pList[i],
		                value : temp[i]
		            }
		        }
		        obj[year+'max'] = Math.floor(max/100) * 100;
		    }
		    return obj;
		}

		function dataMix(list) {
		    var mixData = {};
		    for (var i = 0, l = list.length; i < l; i++) {
		        for (var key in list[i]) {
		            if (list[i][key] instanceof Array) {
		                mixData[key] = mixData[key] || [];
		                for (var j = 0, k = list[i][key].length; j < k; j++) {
		                    mixData[key][j] = mixData[key][j] 
		                                      || {name : list[i][key][j].name, value : []};
		                    mixData[key][j].value.push(list[i][key][j].value);
		                }
		            }
		        }
		    }
		    return mixData;
		}
	</script>

	<style>
	*:not(h4){
		font-size:12px!important;
	}
	*{
		/* text-transform:uppercase!important; */
	}
	</style>

</head>

<body>

	<!-- HEADER -->

	<?php echo $body?>

	<!-- FOOTER -->
