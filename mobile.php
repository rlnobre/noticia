<?php
include("conexao_db.php"); 

$mysql = new conexao;
$listanoticia = $mysql->sql_query("SELECT * FROM noticia where status in(1,3) order by data desc");
$desconecta;
?>
<!DOCTYPE html> 
<html> 
	<head> 
	<title>Not&iacutecias Mobile</title> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a3/jquery.mobile-1.0a3.min.css" />	
	<link rel="STYLESHEET" type="text/css" href="estilos.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.0a3/jquery.mobile-1.0a3.min.js"></script>
</head> 
<body> 

<div class="box_mobile" data-role="page">
	<div class="tbox" data-role="header">
		<p class="p_mobile">Not&iacutecias </p>
	</div>

	<div data-role="content">	
<?php
 while($resultado = mysql_fetch_object($listanoticia)){
  echo   "<p><b>$resultado->titulo</b></p>";
  echo   "<p>$resultado->resumo</p>";
  echo   "<p>$resultado->descricao</p>";
  echo   "<br>";
  echo   "<br>";
}
?>
	</div>
</div>

</body>
</html>