<?php
    include_once "../dataAccess/conexaoDAO.php";
    include_once "../domainModel/usuario.php";
     
      
    class usuarioDAO extends conexaoDAO{
     

        //inserir
        public function inserir(Usuario $obj){
            //status = 1 significa que o usuario esta ativo
            $query = sprintf("INSERT INTO usuario(nome,email,senha,nivel,status) VALUES('%s','%s','%s',1,1)",
                    $obj->getUsuario(),$obj->getEmail(),$obj->getSenha());
            
            //iniciar conexao
            $daoConexao = new conexaoDAO();
            $conexaoAberta = $daoConexao->conectar();

            //selecionar banco
            $daoConexao->selecionarBanco(); 

            //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
            $daoConexao->executeQuery($query);

            //fecha conexao
            $daoConexao->desconectar($conexaoAberta);
           
        }
        
        //Abrir
        public function abrir($id){
            $query = sprintf("SELECT * FROM usuario WHERE idUsuario = '%s'",$id);
            
             //iniciar conexao
            $daoConexao = new conexaoDAO();
            $conexaoAberta = $daoConexao->conectar();

            //selecionar banco
            $daoConexao->selecionarBanco(); 

            //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
            $daoConexao->executeQuery($query);

            //fecha conexao
            $daoConexao->desconectar($conexaoAberta);
  
        }
    }

?>
