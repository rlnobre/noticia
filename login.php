<?php

$erro = '';

if(isset($_POST['login']) && isset($_POST['senha'])){

  $login = $_POST['login'];
  $senha = $_POST['senha'];
  
  if( $login != 'intranet' || $senha != 'intranet' ) {
    $erro = "N&atildeo foi poss&iacutevel realizar login! Favor verificar usu&aacuterio/senha.";
  }else{
    session_start();
    $_SESSION['login'] = $_POST['login'];
    $_SESSION['senha'] = $_POST['senha'];
    header("Location: cpanel.php");
  }
}
?>
<html>
 <head>
 <title> Colaborador </title>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  

 <link rel="STYLESHEET" type="text/css" href="estilos.css">
 </head> 
 <body>
 <div class="topo">
   <label>Colaborador</label>
 </div>
 <form action="login.php" method="post">
 <div class="box"> 
   <label>
     <span>Login:</span> 
     <input type="text" class="input_text" name="login" id="login"/>
   </label>
   <label>
     <span>Senha:</span> 
     <input type="password" class="input_text" name="senha" id="senha"/> 
   </label>
   <label> 
     <input type="submit" class="button" value="Enviar" /> 
   </label> 
   <?php echo "<label>$erro</label>"; ?>
   
 </div>
 </form>

 </body>
</html>