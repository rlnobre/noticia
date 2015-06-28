<?php
class conexao {

    var $host = "localhost";
    var $user = 'consulta';
    var $senha = 'consulta';
    var $dbase = "db_noticias";
	
	/* var $host = "mysql8.000webhost.com";	
    var $user = 'a6464932_admin';
    var $senha = 'admin123';
    var $dbase = "a6464932_noticia"; */	

    var $query;
    var $link;
    var $resultado;
    
    function MySQL(){
    
    }
  
    function conecta(){
		
	  $this->link = @mysql_connect($this->host,$this->user,$this->senha);
		
      if(!$this->link){
        print "Ocorreu um Erro na conexão MySQL:";
        print "<b>".mysql_error()."</b>";
        die();
      }elseif(!mysql_select_db($this->dbase,$this->link)){
        print "Ocorreu um Erro em selecionar o Banco:";
        print "<b>".mysql_error()."</b>";
        die();
      }
    }

    function sql_query($query){
        $this->conecta();
        $this->query = $query;

        if($this->resultado = mysql_query($this->query)){
            $this->desconecta();
            return $this->resultado;
        }else{
            print "Ocorreu um erro ao executar a Query MySQL: <b>$query</b>";
      print "<br><br>";
      print "Erro no MySQL: <b>".mysql_error()."</b>";
      die();
            $this->desconecta();
        }        
    }

    function desconecta(){
        return mysql_close($this->link);
    }
}
?>