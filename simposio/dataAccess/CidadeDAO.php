<?php
    include_once '../dataAccess/ConexaoDAO.php';
    include_once '../domainModel/Cidade.php';
    
    class CidadeDAO{
        public function Abrir($id){
            $query = "SELECT  * FROM cidade WHERE idCidade = $id ";
           
            
             //iniciar conexao
        $daoConexao = new conexaoDAO();
        $conexaoAberta = $daoConexao->conectar();

        //selecionar banco
        $daoConexao->selecionarBanco();

        //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
        $resultado = $daoConexao->executeQuery($query);

        //fecha conexao
        $daoConexao->desconectar($conexaoAberta);
            
            $novo = new Cidade();
            while($rs = mysql_fetch_array($resultado)){
                 
                 
                $novo->setId(stripslashes($rs['idCidade']));
                $novo->setNome(stripslashes($rs['nome']));
                $novo->setIdEstado($rs['idEstado']);
                return $novo;
            }
                      
        }
        
        public function ListarTodos(){
            $sql = "SELECT  * FROM cidade ORDER BY nome";
            $lista = new ArrayObject();

            $resultado = mysql_query($sql);
            while ($rs = mysql_fetch_array($resultado)) {

                $novo = new Cidade();
                
                

                $novo->setId(stripslashes($rs['idCidade']));
                $novo->setNome(stripslashes($rs['nome']));
                $novo->setIdEstado(stripslashes($rs['idEstado']));
                $lista->append($novo);
            }
            return $lista;
        }
            
        
        
    }
?>
