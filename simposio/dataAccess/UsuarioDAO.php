<?php
    include_once "../dataAccess/ConexaoDAO.php";
    include_once "../domainModel/Usuario.php";
     
      
    class UsuarioDAO{
     

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
        
        //funcao para verificar se o usuario já tem cadastrados os registros pessoas
        public function verificarRegistros($id){
            $query = sprintf("SELECT COUNT(p.cpf) as ok FROM usuario u 
            INNER JOIN pessoa p ON (p.fk_usuario = u.idUsuario) WHERE u.idUsuario = '%s' ", $id);
            
            //iniciar conexao
            $daoConexao = new conexaoDAO();
            $conexaoAberta = $daoConexao->conectar();

            //selecionar banco
            $daoConexao->selecionarBanco(); 

            //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
            $resultado = $daoConexao->executeQuery($query);

            //fecha conexao
            $daoConexao->desconectar($conexaoAberta);
            
            $query = mysql_fetch_assoc($resultado);
            
            //Se a consulta retornar 1 entao a função retornará false
            if($query['ok'] != 0){
                return true;
            }else{
                return false;
            }
        }
        
        //função que verifica se usuario já existe no sistema
        public function verificarUser($nick){
            $query = sprintf("SELECT COUNT(idUsuario) as ok FROM usuario WHERE nome LIKE UPPER('%s')",$nick);
            
            //iniciar conexao
            $daoConexao = new conexaoDAO();
            $conexaoAberta = $daoConexao->conectar();

            //selecionar banco
            $daoConexao->selecionarBanco(); 

            //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
            $resultado = $daoConexao->executeQuery($query);

            //fecha conexao
            $daoConexao->desconectar($conexaoAberta);
            
            $query = mysql_fetch_assoc($resultado);
            
            if($query['ok'] == 1){
                return true;
            }else{
                return false;
            }
        }
        
          //função que verifica se email já existe no sistema
        public function verificarEmail($email){
            $query = sprintf("SELECT COUNT(idUsuario) as ok FROM usuario WHERE email like '%s' ",$email);
            
            //iniciar conexao
            $daoConexao = new conexaoDAO();
            $conexaoAberta = $daoConexao->conectar();

            //selecionar banco
            $daoConexao->selecionarBanco(); 

            //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
            $resultado = $daoConexao->executeQuery($query);

            //fecha conexao
            $daoConexao->desconectar($conexaoAberta);
            
            $query = mysql_fetch_assoc($resultado);
            
            if($query['ok'] == 1){
                return true;
            }else{
                return false;
            }
        }
        
    }

?>
