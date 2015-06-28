<?php
session_start();
if(empty( $_SESSION['login'])){
  echo "Acesso Negado.";
  die();
}

header("Content-Type: text/html; charset=ISO-8859-1",true);

include("conexao_db.php");

$mysql = new conexao;
$listanoticia = $mysql->sql_query("SELECT n.titulo
                                          ,n.resumo
										  ,n.descricao
										  ,DATE_FORMAT(n.data,'%d/%m/%Y %H:%i:%s') data
										  ,case n.status
									          when 0 then 'Remover Notícia'
									          when 1 then 'Visivel no Site e Mobile'
											  when 2 then 'Visivel apenas no Site'
											  when 3 then 'Visivel apenas no Mobile'
										    end as status
									  FROM noticia n
									 ORDER BY n.data desc");
$desconecta;

$erro = '';
$val_titulo = '';
$val_resumo = '';
$val_desc = '';
$alterar = 'N';
$val_status = '';

if(isset($_GET['erro'])){
  if($_GET['erro']=='0'){
    $erro = "<label class='erro'>Favor informar todos os campos para criar uma nova Not&iacutecia!</label>";
  }elseif($_GET['erro']=='1'){
	 $erro =  "<label class='erro'>Not&iacutecia j&aacute Existe! Para alterar modifique as informa&ccedil;&atilde;es acima e clique em Gravar.</label>";
    
	 $alterar = 'S';
	 $tit = $_GET['tit'];
	 $mysql = new conexao;
     $listainforma = $mysql->sql_query("SELECT n.titulo
                                              ,n.resumo
				         		  			   ,n.descricao
						         			   ,DATE_FORMAT(n.data,'%d/%m/%Y %H:%i:%s') data
									           ,case n.status
									              when 0 then 'Remover Notícia'
									              when 1 then 'Visivel no Site e Mobile'
											      when 2 then 'Visivel apenas no Site'
											      when 3 then 'Visivel apenas no Mobile'
									            end as status
								            FROM noticia n
								           WHERE n.titulo ='".$tit."'");
    $desconecta;
	
	while($result = mysql_fetch_object($listainforma)){
		$result->data;
		$val_titulo = $result->titulo;
		$val_resumo = $result->resumo;
		$val_desc = $result->descricao;
		$val_status = $result->status;
	}
	 
  }elseif($_GET['erro']=='2'){
	 $erro = "<label class='erro'>Not&iacutecia Cadastrada!</label>";		 
  }
}
?>
<html>
 <head>
 <title>Colaborador </title>
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
 <link rel="STYLESHEET" type="text/css" href="estilos.css">
 </head>

 <body>
 <div class="topo">
   <label>Colaborador - Gerenciamento de Not&iacutecias </label>
 </div>
 <form name = "myForm" action="gravar_noticia.php<?php echo "?alterar=$alterar";?>" method="post" enctype="multipart/form-data">
 <br>
 <div class="boxnoticia"> 
   <label>
     <span>Titulo:</span> 
     <input type="text" class="input_text" name="titulo" id="titulo" value="<?php echo $val_titulo; ?>" />
   </label>
   <label>
     <span>Resumo:</span> 
     <input type="text" class="input_text" name="resumo" id="resumo" value="<?php echo $val_resumo; ?>"/> 
   </label>
   <label>
     <span>Descri&ccedil;&atilde;o:</span> 
     <textarea class="message" name="desc" id="desc" ><?php echo $val_desc; ?></textarea>	 
   </label> 
   <label>
     <input type="file" name="imagem"/>
   </label>
   <label>
     <span>Status:</span>
       <select multiple name="status">
          <option value="0" <?php if($val_status == 'Remover Notícia') echo "selected='selected'";?>>Remover Not&iacutecia</option>
          <option value="1" <?php if($val_status == 'Visivel no Site e Mobile') echo "selected='selected'";?>>Visivel no Site e Mobile</option>
          <option value="2" <?php if($val_status == 'Visivel apenas no Site') echo "selected='selected'";?>>Visivel apenas no Site</option>
		  <option value="3" <?php if($val_status == 'Visivel apenas no Mobile') echo "selected='selected'";?>>Visivel apenas no Mobile</option>
       </select>
   </label>   
   <label> 
     <input type="submit" class="button" value="Gravar" /> 
   </label>
   <br>   
     <?php
        echo $erro;
     ?>
   <br>
   <span class='listanoticia'><b>Ultimas Not&iacutecias Cadastradas:</b></span>
   <br>
   <div class="div-table">
     <div class="div-table-col">Data</div>
     <div class="div-table-col">Titulo</div>
     <div class="div-table-col">Status</div>
   </div>
   
   <div class="div-table-row">
   <?php
   while($resultado = mysql_fetch_object($listanoticia)){
	 
     echo "<div class='div-table-row'>
	        <div class='div-table-col'>
	          <span class='listanoticia')>$resultado->data</span>
	        </div>";
	   
     echo "<div class='div-table-col'>
	        <span class='listanoticia')>$resultado->titulo</span>
	       </div>";
			
     echo "<div class='div-table-col'>
	        <span class='listanoticia')>$resultado->status</span>
			
	       </div>
		</div>";
   }
   ?>
 </div>
 </form>

 </body>
</html>