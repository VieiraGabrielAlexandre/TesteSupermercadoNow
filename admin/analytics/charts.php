<?php
  $d= dirname(__FILE__);
  include $d .'/../bootstrap.php'; 
  valida_login();
  global $config;

// error_reporting(E_ALL);

?>

<style>
.anv,.anw,.graphic .ant{position:relative}
.anv,.title-grafico{text-transform:uppercase}
body{margin:0;padding:0;font-family:Roboto,"Helvetica Neue",Helvetica,Arial,sans-serif;font-size:14px;line-height:1.5;color:#cfd2da;background-color:#252830}
h1,h2,h3,h4{font-weight:300;color:#fff;font-size:30px}
hr{border:0;border-top:1px solid #434857;margin-top:10px}
.anx,.navbar{margin-top:0}
.navbar{background:#111;border:0;border-radius:0}
.navbar-default .navbar-nav>.active>a,.navbar-default .navbar-nav>.open>a{background-image:linear-gradient(to bottom,#252830 0,#252830 100%)}
.graphic .ant{z-index:50}
.graphic .cols{padding:0;margin:0;text-align:center}
.anx{margin-bottom:0;font-size:100%;color:inherit}
.anw{z-index:2;display:inline-block;padding-left:1em;padding-right:1em;color:#6f7890;vertical-align:middle;background-color:#252830}
.anv{font-size:12px;line-height:20px;text-align:center}
.anv:before{position:absolute;top:50%;display:block;content:"";width:100%;height:1px;background-color:#434857}
.bk-verde{background-color:#1bc98e}
.bk-roxo{background-color:#9f86ff}
.bk-vermelho{background-color:#e64759}
.bk-amarelo{background-color:#e4d836}
.box-grafico{width:25%;float:left;padding:20px}
.padding-20{padding:20px!important}
.title-grafico{font-size:85%;letter-spacing:.15em;color:rgba(255,255,255,.65)}
.valor-grafico{padding:0;margin:0}
.porcentagem-grafico{margin-left:10px;font-size:40%;color:#fff}
.linha-branca{margin-left:-20px;margin-right:-20px;border-top-color:rgba(255,255,255,.2)}
canvas{display:block;vertical-align:baseline}
.container-full{width:100%;padding:0 20px 20px}
</style>

<?php
if(!isset($_GET['metric']) || !$_GET['metric'])
  die('Graph without \'metric\'');

if(!isset($_GET['dimension']) || !$_GET['dimension']){
  $_GET['dimension'] = 'day';
}

if(!isset($_GET['color']) || !$_GET['color'])
  $color = '1bc98e';
else
  $color = $_GET['color'];

if(!isset($_GET['title']) || !$_GET['title'])
  $title = $_GET['metric'];
else
  $title = $_GET['title'];

require 'gapi.class.php';
define('ga_profile_id',$config['analytics_profile']);

$ga = new gapi("analytics@melodic-scarab-123214.iam.gserviceaccount.com", "key.p12");

if(isset($_GET['date']) && $_GET['date'] == 'last_30'){
  $data_inicio = strtotime('-30 days');
  $data_fim = strtotime('now');
}else{
  $data_inicio = strtotime(date('Y-m-1'));
  $data_fim = strtotime(date('Y-m-t'));
}

$ga->requestReportData(ga_profile_id,array($_GET['dimension']),array($_GET['metric']),'-'.$_GET['dimension'], null, $data_inicio, $data_fim);
$res = array_reverse($ga->getResults());
$labels = '[';
$values = '[{data:[';
$total = 0;
$hoje = date('d');
$json = array();
foreach($res as $result){
  $labels .= '\''.$result->{"get".ucfirst($_GET['dimension'])}().'\',';
  $values .= ''.$result->{"get".ucfirst($_GET['metric'])}().',';

  if(($_GET['metric'] == 'avgSessionDuration')){
    $seconds = $result->{"get".ucfirst($_GET['metric'])}();
    $hours = floor($seconds / 3600);
    $mins = floor(($seconds - ($hours*3600)) / 60);
    $secs = floor($seconds % 60);
    $total = ($hours<10?'0'.$hours:$hours).':'.($mins<10?'0'.$mins:$mins).':'.($secs<10?'0'.$secs:$secs);
  }else{
    $total = round($result->{"get".ucfirst($_GET['metric'])}());
  }

  if($result->{"get".ucfirst($_GET['dimension'])}() == $hoje)
    $total_hoje = $total;

  $json[(int)$result->{"get".ucfirst($_GET['dimension'])}()] = $total;

}
$labels = rtrim($labels,',').']';
$values = rtrim($values,',').']}]';

?>

<div style="background-color:#<?php echo $color;?>">
  <div class="padding-20">
    <span class="title-grafico"><?php echo $title;?></span>
    <h2 class="valor-grafico"><?php echo $total_hoje;?><small class="porcentagem-grafico">hoje</small></h2>
    <hr class="linha-branca">
  </div>
  <canvas id="sparkline1" width="189" height="47" class="apv" data-chart="spark-line" data-value="<?php echo $values;?>" data-labels="<?php echo $labels;?>" style="width: 189px; height: 47px;"></canvas>
</div>

<script>
parent.window['analytics_<?php echo $_GET['metric'];?>'] = <?php echo json_encode($json);?>;
</script>
<?php include $d .'/../footer.php';  ?>

