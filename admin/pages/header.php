<?php global $config, $template_default_vars;
?>

<?php if(!isset($hide_header)){?>

<!-- Main navbar -->
<div class="navbar navbar-inverse">
  <div class="navbar-header">
    <a class="navbar-brand" href="<?php echo $config['baseurl_admin'];?>">
      <?php echo strtoupper($template_default_vars['page_title']);?>
    </a>

    <ul class="nav navbar-nav visible-xs-block">
      <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
      <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
    </ul>
  </div>

  <div class="navbar-collapse collapse" id="navbar-mobile">

    <ul class="nav navbar-nav">
      <li><a class="sidebar-control sidebar-main-toggle hidden-xs" onClick="triggerResize();changeSidebar();"><i class="icon-paragraph-justify3"></i></a></li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown dropdown-user">
        <a class="dropdown-toggle" data-toggle="dropdown">
          <img src="<?php echo $config['static_baseurl']?>/images/webclip.jpg" alt="">
          <span><?php echo $_SESSION['#admin']['nome'];?></span>
          <i class="caret"></i>
        </a>

        <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="<?php echo $config['baseurl_admin']?>/usuarios/listar"><i class="icon-user-plus"></i> Usuários admin</a></li>
          <li class="divider"></li>
          <li><a href="<?php echo $config['baseurl_admin']?>/usuarios/listar/<?php echo $_SESSION['#admin']['uid'];?>"><i class="icon-user"></i> Meus dados</a></li>
          <li><a href="<?php echo $config['baseurl_admin']?>/logout"><i class="icon-switch2"></i> Sair</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>
<!-- /main navbar -->
<?php } ?>

<!-- Page container -->
  <div class="page-container">

    <!-- Page content -->
    <div class="page-content">

      <?php if(!isset($hide_header)){?>
      <!-- Main sidebar -->
      <div class="sidebar sidebar-main">
        <div class="sidebar-content">

          <!-- Main navigation -->
          <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
              <ul class="navigation navigation-main navigation-accordion">
                <li>
                  <?php
                    $url_site = $config['baseurl']."/".$_GET['q'];
                    foreach($config['admin']['menu'] as $a => $v){
                      echo '<li>';
                      if(isset($v['submenu']) && $v['submenu']){
                        echo '<a href="'. $v['url'] .'"><i class="'. $v['icon'] .'"></i> <span>'. $v['title'] .'</span></a>';
                        echo '<ul>';
                          foreach($v['submenu'] as $aa => $vv){
                          
                            // vou criar um if para empresas e usuarios pois a url é igual
                            $url_limpa = explode('?', $vv['url']);
                            if($_GET['q'] == "admin/cadastro/empresas"){
                              if($_GET['tipo'] == "distribuidor") $active = ($vv['url'] == $url_site."?tipo=distribuidor" ? "active" : "");
                              if($_GET['tipo'] == "pdv") $active = ($vv['url'] == $url_site."?tipo=pdv" ? "active" : "");
                              if($_GET['tipo'] == "atacadista") $active = ($vv['url'] == $url_site."?tipo=atacadista" ? "active" : "");
                              if($_GET['tipo'] == "doceiros") $active = ($vv['url'] == $url_site."?tipo=doceiros" ? "active" : "");

                            }else if($_GET['q'] == "admin/cadastro/usuarios"){
                              if($_GET['empresa-tipo'] == "distribuidor"){
                                 if($_GET['tipo'] == "proprietario") $active = ($vv['url'] == $url_site."?empresa-tipo=distribuidor&tipo=proprietario" ? "active" : "");
                                 if($_GET['tipo'] == "gerente") $active = ($vv['url'] == $url_site."?empresa-tipo=distribuidor&tipo=gerente" ? "active" : "");
                                 if($_GET['tipo'] == "supervisor") $active = ($vv['url'] == $url_site."?empresa-tipo=distribuidor&tipo=supervisor" ? "active" : "");
                                 if($_GET['tipo'] == "vendedor") $active = ($vv['url'] == $url_site."?empresa-tipo=distribuidor&tipo=vendedor" ? "active" : "");
                              }

                              if($_GET['empresa-tipo'] == "atacadista"){
                                 if($_GET['tipo'] == "proprietario") $active = ($vv['url'] == $url_site."?empresa-tipo=atacadista&tipo=proprietario" ? "active" : "");
                              }

                              if($_GET['empresa-tipo'] == "pdv"){
                                 if($_GET['tipo'] == "proprietario") $active = ($vv['url'] == $url_site."?empresa-tipo=pdv&tipo=proprietario" ? "active" : "");
                              }

                              if($_GET['empresa-tipo'] == "doceiros"){
                                 if($_GET['tipo'] == "proprietario") $active = ($vv['url'] == $url_site."?empresa-tipo=doceiros&tipo=proprietario" ? "active" : "");
                                 if($_GET['tipo'] == "gerente") $active = ($vv['url'] == $url_site."?empresa-tipo=doceiros&tipo=gerente" ? "active" : "");
                              }
                            } else {
                              $active = ($url_site == $url_limpa[0] ? "active" : "");
                            }

                            echo '<li class="'. $active .'"><a href="'. $vv['url'] .'"><i class="'. $vv['icon'] .'"></i><span> '. $vv['title'] .'</span></a></li>';
                          }
                        echo '</ul>';
                      }else{
                        echo '<li class="'. ($v['url'] == $url_site ? "active" : "") .'"><a href="'. $v['url'] .'"><i class="'. $v['icon'] .'"></i> <span>'. $v['title'] .'</span></a></li>';
                      }
                      echo '</li>';
                    }
                  ?>
                </li>
              </ul>
            </div>
          </div>
          <!-- /main navigation -->

        </div>
      </div>
      <!-- /main sidebar -->

      <?php } ?>

      <!-- Main content -->
      <div class="content-wrapper">

        <!-- Content area -->
