<?php
    include_once "../dataAccess/ConexaoDAO.php";
    include_once "../domainModel/Instituicao.php";
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Instituicao
 *
 * @author emerson
 */
class InstituicaoDAO {
    
    //put your code here
    //inserir
    public function iserir(Instituicao $obj){
       $query = sprintf("INSERT INTO instituicao(nome,status) VALUES('%s',1)",$obj->getNome());
        
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
    //abrir
    public function abrir($id){
       $query = sprintf("SELECT * FROM instituicao WHERE idInstituicao = '%s'",$id);

       //iniciar conexao
       $daoConexao = new conexaoDAO();
       $conexaoAberta = $daoConexao->conectar();

       //selecionar banco
       $daoConexao->selecionarBanco();

       //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
       $resultado = $daoConexao->executeQuery($query);

       //fecha conexao
       $daoConexao->desconectar($conexaoAberta);
       
       while($rs = mysql_fetch_array($resultado)){
            $novo = new Instituicao();	
            
            $novo->setId(stripslashes($rs['idInstituicao']));
	    $novo->setNome(stripslashes($rs['nome']));
            return $novo;
       }
    }
    //listar todos
    public function listarTodos() {

       $query = "SELECT * FROM instituicao WHERE status = 1";
      
       //iniciar conexao
       $daoConexao = new conexaoDAO();
       $conexaoAberta = $daoConexao->conectar();

       //selecionar banco
       $daoConexao->selecionarBanco();

       //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
       $resultado = $daoConexao->executeQuery($query);

       //fecha conexao
       $daoConexao->desconectar($conexaoAberta);
       
       $lista = new ArrayObject();

       while ($rs = mysql_fetch_array($resultado)) {

           $novo = new Instituicao();
           
           $novo->setId(stripslashes($rs['idInstituicao']));
           $novo->setNome(stripslashes($rs['nome']));
           
           $lista->append($novo);
       }
       return $lista;
   }
    
}

?>
