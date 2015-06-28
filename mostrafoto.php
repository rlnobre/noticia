<?php
    include("conexao_db.php");
	$mysql = new conexao;
    $titulo = $_GET["titulo"];
    $lista = $mysql->sql_query("SELECT imagem FROM noticia where titulo = '".$titulo."'");
	$resultado = mysql_fetch_object($lista);
    $desconecta;

	Header( "Content-type: image/gif"); 
	echo $resultado->imagem;
?>