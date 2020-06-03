<?php global $config;?>


<script src="/static/js/jquery.datetimepicker.full.min.js" > </script>
<link rel="stylesheet" href="/static/css/jquery.datetimepicker.min.css" crossorigin="anonymous">
 
<div class="pagina">
  <?php include('header.php'); ?>
	<!-- #######  YAY, I AM THE SOURCE EDITOR! #########-->
	<h1 style="text-align: CENTER;">Bem vindo <?php echo $_SESSION['#admin']['nome']?> ao painel admistrador do Bioma Web Site</h1>
	<h1 style="color: #2e6c80; text-align: center;">Usuabilidade:</h1>
	<ol style="list-style: none; font-size: 14px; line-height: 32px; font-weight: bold;">
	<li style="clear: both; text-align: center;">
	<h1><img style="float: center;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAclBMVEX///8AAACYmJgUFBTz8/Pv7++Tk5OhoaH4+PgYGBj8/PxRUVFTU1Pn5+fNzc1FRUVLS0taWlpAQEDY2Njf39+np6ednZ22travr68MDAyKioosLCxpaWmysrJkZGQcHBw5OTm+vr50dHQqKip/f38yMjK7LmRqAAAEZ0lEQVR4nO3db1uiQBSH4fEfsZhmhppZmrV9/6+4FjOA21lgYOacmfb3vExluBNkhLpQqn/5eDUZ+euUDFg3F+W3HnVF80wS+OLdd+lWkPjIARyNVmLAJQ9wNLqTehdPXEKpfXHDBrwQRYSvZvjj9sZPm3lJvBMA5mbwB39jZNXBaMW/oZ710I8+B8nuSyL/QWOrR555HSWrNlT2fTEpxp34FSpVEdeeR/o7LmFtQ2U+aHAJ5YhsQqWqT1TWg4ZHYZbsR3fL2g+qfZHzoOFRePxaco2Yihw0/AmX37dIkYOGP+G4WPJpWv+hwEHDn1Av+df1kqsNlWtf9P4e/iXkP2hwC6+m4c7HpGIX1o+LLPuigJB5QxUQ1jdUBqKEkHcCJyNUjN/6hYSM+6KQ0NMELi2rfm1SQg8TuIeneXV16bA1P5YTOv5EzavtvuhJPyAnVGlFHP5liri6tCgeERTW98WhEzjqzL0+AywprO+Lw46L5NWlvHhMVujoVHF2IIAf+kFZ4dXHTf+hyKtL+i2UFrrZUNdmEc/JWLcrTy2ICx1M4Bb69Xvy6pK8cPgZuJ1+OX11SV44/KBhri4tyEcDEA6ewOmRJlPy0SCEA79pRCAcSIxBePWJ2nekwIX1Exu272IkwgEbaiTC+kHj2Guk4IX1DXXZ/uTvI0UgrKbh4z4jsQubZxpk5b4Yh9DMFl8sXjPbxyQ0M36bvyebTmISZuW3trekuU25IccltPm7zp1+SWTC7L07UQ8fmdDm76v1x1FsQovtVJ+Dj07Y/d8A9CQmPqFadPtflVv99AiFX1eE3ifNHX6n+slRCi9NZ82l1TMjFXYPQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQjoIIeQMQrr/XWjuaRuG0NyddWv1qmbhWS/z0cUKDs7cL3HX/tRazcJcL9PmnrbeetC3A7a5S7JqE6pXQ3xOxrIlz2ZV1na/mBahxT1t2do4FaqTrIbokLkVWtzTlim7e8e3C4PbTi230Q7C8i7oYWR3pOgm7HpPW47uc2tgF+HXPW0nsrTPVZw/9ToqdxJeSuXrw7MQxhuE8Qdh/EHI3jm5sfv+11ZgwunH59pYzz2bCkz4VqxOj8nZPwtLmL4Xq+PyTQxLONPT38ThMiHkDcI+QcgbhH36+UJzdcntXLBvM702dleXmjPnCsO6unR2uExzTW4fxNUlvTJO56VqbZZ6vBFuezSr8uoSGNxZ+8+cfntS2UHa862TU+BPuLrUWmjbqYeP9Rdp01X2V5c6lB/bB2aqz9WlbsbxKoCrS6vxEN8fZQpTjzuyjJUAAAAASUVORK5CYII=" alt="interactive connection" width="45" /> Voc&ecirc; editar p&aacute;ginas</h1>
	</li>
	<li style="clear: both; text-align: center;"></li>
	<li style="clear: both; text-align: center;">
	<h1><img style="float: center;" src="https://cdn.pixabay.com/photo/2018/05/01/15/06/user-3365840_960_720.png" alt="html cleaner" width="45" />Administrar usuarios</h1>
	</li>
	<li style="clear: both;">
	<h1 style="text-align: center;">&nbsp;</h1>
	<ol style="list-style-type: none;">
	<li style="clear: both;">
	<h1 style="text-align: center;">E outras funcionalidades !</h1>
	</li>
	</ol>
	</li>
	</ol>
<?php include('footer.php'); ?>

</div>


<script>
var callback_ajax = {
	before: function(form, formData) {
		
		return formData;
	},
	erro: function(res, form, markInput) {
		markInput($('#email', form));
	},
	sucesso: function(res, form) {
		setTimeout(() => {
			window.location.href = window.location.href;
			
		}, 2000);
	}
};

var callback_ajax_esqueci_senha = {
	before: function(form, formData) {
		return formData;
	},
	erro: function(res, form, markInput) {
		//markInput($('#cpf', form));
	},
	sucesso: function(res, form) {
		window.location.href = res.url;
	}
};
</script>
