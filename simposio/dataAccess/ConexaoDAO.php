
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of conexaoDAO
 *
 * @author emerson
 */
class ConexaoDAO {
    private $user = "root";
    private $passwd = "";
    private $server = "localhost";
    private $database = "bdevento";
    
    function __construct() {
        $this->user;
        $this->passwd;
        $this->server;
        $this->database;
    }

    
    //inicia uma conexao
    public function conectar(){
        $conexao = mysql_connect($this->server, $this->user, $this->passwd) or die(mysql_error());
       
        return $conexao;        
    }
    
    //selecionar banco
    public function selecionarBanco(){
        $base = mysql_select_db($this->database) or die(mysql_errno());
        
        if($base){
            return true;
        }else{
            return false;
        }
    }
    
    //execultar query
    public function executeQuery($sql){
        $query = mysql_query($sql) or die(mysql_error());
        
        return $query;
        
    }

    //fecha a conexao
    public function desconectar($conexaoAberta){
        //se a conexao estiver aberta será fechada
        if ($conexaoAberta){
            mysql_close($conexaoAberta) or die(mysql_error());
        }
    }
}

?>
