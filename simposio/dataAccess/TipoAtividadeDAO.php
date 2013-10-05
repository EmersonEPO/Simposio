<?php
    include_once "../dataAccess/ConexaoDAO.php";
    include_once "../domainModel/TipoAtividade.php";

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoAtividadeDAO
 *
 * @author Home
 */
class TipoAtividadeDAO {
    //put your code here
    //inserir
    public function inserir(TipoAtividade $obj){
        $query = sprintf("INSERT INTO tipoatividade(status,nome) VALUES('%s',1)",$obj->getNome());
        
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
    //atualizar
    public function atualizar(TipoAtividade $obj){
        $query = sprintf("UPDATE tipoatividade SET nome='%s' WHERE idTipoAtv = '%s' ",$obj->getNome(),$obj->getId);
        
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
     public function abrir($id) {
        $query = sprintf("SELECT * FROM tipoatividade WHERE idTipoAtv = '%s'",$id);

        //iniciar conexao
        $daoConexao = new conexaoDAO();
        $conexaoAberta = $daoConexao->conectar();

        //selecionar banco
        $daoConexao->selecionarBanco();

        //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
        $resultado = $daoConexao->executeQuery($query);

        //fecha conexao
        $daoConexao->desconectar($conexaoAberta);

        while ($rs = mysql_fetch_array($resultado)) {

            $novo = new TipoAtividade();

            $novo->setNome(stripslashes($rs['nome']));
          
            return $novo;
        } 
    }
    //apagar
    public function apagar($id){
        $query = sprintf("UPDATE tipoatividade SET status = 0 WHERE idTipoAtv = '%s'",$id);
        
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
    //listarTodos
    public function listaTodos() {
        $query = "SELECT * FROM tipoatividade WHERE status = 1";

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

            $novo = new TipoAtividade();

            $novo->setNome(stripslashes($rs['nome']));

            $lista->append($novo);
        }
        return $lista;
    }
}

?>
