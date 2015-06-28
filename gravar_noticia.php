<?php
session_start(); 
if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true)) { 
  unset($_SESSION['login']); 
  unset($_SESSION['senha']); 
  header('location:login.php'); 
}


if(empty($_POST['titulo']) || empty($_POST['resumo']) || empty($_POST['desc'])){
	header("Location: cpanel.php?erro=0");
}

include("conexao_db.php");

$titulo = $_POST['titulo'];

if(isset($_GET['alterar']))
	$alterar = $_GET['alterar'];
else
    $alterar = '';

echo 'AQUIII:'.$alterar;

if(isset($_POST['resumo']))
	$resumo = $_POST['resumo'];

if(isset($_POST['desc']))
	$desc = $_POST['desc'];

if(isset($_POST['delete']))
	$delete = $_POST['delete'];

if(isset($_POST['site']))
	$site = $_POST['site'];

if(isset($_POST['mobile']))
	$mobile = $_POST['mobile'];

if(isset($_POST['status']))
	$status = $_POST['status'];
else
	$status = '';


$imagem = $_FILES["imagem"];
if($imagem != NULL) { 
  $nomeFinal = time().'.jpg'; 
  if (move_uploaded_file($imagem['tmp_name'], $nomeFinal)) { 
    $tamanhoImg = filesize($nomeFinal); 
	$mysqlImg = addslashes(fread(fopen($nomeFinal, "r"), $tamanhoImg)); 
	unlink($nomeFinal); 
  } 
} 

$mysql = new conexao;

$consulta = "SELECT count(*) existe
   		       FROM noticia n
		      WHERE n.titulo='".$titulo."'";

$listanoticia = $mysql->sql_query($consulta);
								 
$desconecta;

$resultado = mysql_fetch_object($listanoticia);

if($resultado->existe > 0){
	if($alterar == 'N')
      header("Location: cpanel.php?erro=1&tit=$titulo");
    elseif($alterar == 'S'){
      $alterar = "UPDATE noticia SET resumo = '".$resumo."', descricao = '".$desc."', imagem = '".$mysqlImg."', status = ".$status." WHERE titulo = '".$titulo."'";

      $alteranoticia = $mysql->sql_query($alterar);
  
      header("Location: cpanel.php");
	}
} else{
  
  $inserir = "insert into noticia values('".$titulo."','".$resumo."','".$desc."','".$mysqlImg."',".$status.",sysdate())";

  $listanoticia = $mysql->sql_query($inserir);
  
  header("Location: cpanel.php?erro=2");
	
}

?>