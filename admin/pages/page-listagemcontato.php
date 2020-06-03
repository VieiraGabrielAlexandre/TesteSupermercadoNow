<?php global $config; ?>
<?php require_once('header.php'); ?>

<style>
.text-semibold {font-weight: 800;}
</style>

<script>
$(document).ready(function(){
  var porcentagem = <?php echo $mini_dados['porcentagem_curtidas'];?>;
  progressPercentage('#progress_percentage_two', 36, 3, "#eee", "#670099", porcentagem/100);

  var porcentagem = <?php echo $mini_dados['porcentagem_assitidas'];?>;
  progressPercentage('#progress_percentage_3', 36, 3, "#eee", "#670099", porcentagem/100);
});


function progressPercentage(element, radius, border, backgroundColor, foregroundColor, end) {

    // Basic setup
    // ------------------------------

    // Main variables
    var d3Container = d3.select(element),
        startPercent = 0,
        fontSize = 22,
        endPercent = end,
        twoPi = Math.PI * 2,
        formatPercent = d3.format('.0%'),
        boxSize = radius * 2;

    // Values count
    var count = Math.abs((endPercent - startPercent) / 0.01);

    // Values step
    var step = endPercent < startPercent ? -0.01 : 0.01;


    // Create chart
    // ------------------------------

    // Add SVG element
    var container = d3Container.append('svg');

    // Add SVG group
    var svg = container
        .attr('width', boxSize)
        .attr('height', boxSize)
        .append('g')
            .attr('transform', 'translate(' + radius + ',' + radius + ')');


    // Construct chart layout
    // ------------------------------

    // Arc
    var arc = d3.svg.arc()
        .startAngle(0)
        .innerRadius(radius)
        .outerRadius(radius - border)
        .cornerRadius(20);


    //
    // Append chart elements
    //

    // Paths
    // ------------------------------

    // Background path
    svg.append('path')
        .attr('class', 'd3-progress-background')
        .attr('d', arc.endAngle(twoPi))
        .style('fill', backgroundColor);

    // Foreground path
    var foreground = svg.append('path')
        .attr('class', 'd3-progress-foreground')
        .attr('filter', 'url(#blur)')
        .style({
          'fill': foregroundColor,
          'stroke': foregroundColor
        });

    // Front path
    var front = svg.append('path')
        .attr('class', 'd3-progress-front')
        .style({
          'fill': foregroundColor,
          'fill-opacity': 1
        });


    // Text
    // ------------------------------

    // Percentage text value
    var numberText = svg
        .append('text')
            .attr('dx', 0)
            .attr('dy', (fontSize / 2) - border)
            .style({
                'font-size': fontSize + 'px',
                'line-height': 1,
                'fill': foregroundColor,
                'text-anchor': 'middle'
            });


    // Animation
    // ------------------------------

    // Animate path
    function updateProgress(progress) {
        foreground.attr('d', arc.endAngle(twoPi * progress));
        front.attr('d', arc.endAngle(twoPi * progress));
        numberText.text(formatPercent(progress));
    }

    // Animate text
    var progress = startPercent;
    (function loops() {
        updateProgress(progress);
        if (count > 0) {
            count--;
            progress += step;
            setTimeout(loops, 10);
        }
    })();
}
</script>


<!-- Page header -->
  <div class="page-header">
    <div class="page-header-content">

      <div class="page-title">
        <h4><span class="text-purple"><?php echo $grid['name']?></span>
          <small class="display-block"></small>
        </h4>
      </div>

      <div class="heading-elements">
      <?php 
      if(isset($grid['buttons-head']) && $grid['buttons-head']){
          foreach ($grid['buttons-head'] as $b => $bt) {
            echo '<a class="btn btn-link btn-float has-text" href="'.$bt['url'].'"><i class="'.$bt['icon'].'"></i><span> '.$bt['title'].'</span></a>';
          }
        }
      ?>
      </div>
      <?php if($_SESSION['#admin']['tipo'] == '1'){ ?>
      <div class="heading-elements">
        <a href="./contato?type=novo"><button class="btn bg-success" type="button" style="float:right;">Nova Página</button></a>
        <!-- <a href="?exportar-posts"><button class="btn bg-success" type="button" style="float:right;margin-right:15px;">Exportar análise diária</button></a> -->
      </div>
      <?php } ?>
    </div>
  </div>
  <!-- /page header -->

  <!-- Page container -->
  <div class="page-container">


<script>
var pagination_default = <?php echo $grid['config']['pagination-default']?$grid['config']['pagination-default']:50;?>;
var order_colum = <?php echo $grid['config']['order-colum']?$grid['config']['order-colum']:0;?>;
var order_by = <?php echo $grid['config']['order-by']?'\''.$grid['config']['order-by'].'\'':'ASC';?>;
var show_search = <?php echo $grid['config']['show-search']?$grid['config']['show-search']:'false';?>;
var show_pagination = <?php echo $grid['config']['show-pagination']?$grid['config']['show-pagination']:'false';?>;
var no_order = <?php echo $grid['config']['no-order']?$grid['config']['no-order']:'false';?>;
var no_header = <?php echo $grid['config']['no-header']?'true':'false';?>;
var no_footer = <?php echo $grid['config']['no-footer']?'true':'false';?>;
var no_grid = <?php echo $grid['config']['no-grid']?'true':'false';?>;
var no_filter = <?php echo $grid['config']['no-filter']?'true':'false';?>;
var no_save = <?php echo $grid['config']['no-save']?'true':'false';?>;
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
  <!-- /state saving -->

</div>
<!-- /page header -->

<?php require_once('footer.php'); ?>