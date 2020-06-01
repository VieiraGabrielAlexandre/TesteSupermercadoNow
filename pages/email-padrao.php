<?php
  global $config;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>EMAIL PADRÃO</title>
</head>

<body style="margin:0px"  bgcolor="#00287d">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#00287d" >
<tr>
<td>
<table width="680" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:40px; margin-bottom:20px;">
<tr>
  <td style="text-align:center;">
  <a href="<?php echo $config['baseurl']?>"><img src="<?php echo $config['baseurl']?>/static/images/selo-home.png" border="0" style="display:inline-block;" /></a><br/>
  </td>
</tr>

</table>
<table width="680" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-top:0px; margin-bottom:0px; border:#ccc solid 1px;">
<tr style="background-color:#FFFFFF;">
  <td style="background-color:#FFFFFF;" bgcolor="#fff">
  <font style="border-bottom:#fff; border-top:#fff; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#888; float:left; padding:40px;">
   <!-- começa o conteudo aqui -->
   
    
  <font style="font-size:30px; margin-bottom:8px; color:#302117; display:block;"><?php echo $titulo?></font>
  <font style="font-size:18px; margin-bottom:8px; font-weight:bold; display:block;"><?php echo $subtitulo?></font>
  <?php echo $descricao?>

<?php if(isset($botao) && $botao){?>
<a href="<?php echo $url_botao?>" style="color:#ffffff; font-weight:bold;  background-color:#e91034; padding:15px 20px; display:block; text-align:center; text-decoration:none; text-transform:uppercase;"><?php echo $texto_botao?></a>
<?php } ?>
<!-- termina o conteudo -->
  </font>
  </td>
</tr>
</table>
<br/><br/>
<!-- *********************************** FIM meio -->
</td>
</tr>
</table>
</body>
</html>