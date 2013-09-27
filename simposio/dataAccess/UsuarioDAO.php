<?php
    include_once "../dataAccess/connection.php";
    include_once "../domainModel/Usuario.php";
    
    class UsuarioDAO{
        //inserir
        public function inserir(Usuario $obj){
            //status = 1 significa que o usuario esta ativo
            $query = sprintf("INSERT INTO usuario(nome,email,senha,nivel,status) VALUES('%s','%s','%s',1,1)",
                    $obj->getUsuario(),$obj->getEmail(),$obj->getSenha());
            //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
            mysql_query($query) or die(mysql_error()); 
        }
        
    }

?>
