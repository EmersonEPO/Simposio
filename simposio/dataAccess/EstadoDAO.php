
<?php

include_once "../dataAccess/ConexaoDAO.php";
include_once "../domainModel/Estado.php";
include_once "../domainModel/Cidade.php";

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EstadoDAO
 *
 * @author Home
 */
class EstadoDAO {

    //put your code here
    //listar todos
    public function listarTodos() {
        $query = "SELECT * FROM estado";

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

            $novo = new Estado();

            $novo->setId(stripslashes($rs['idEstado']));
            $novo->setNome(stripslashes($rs['nome']));
            $novo->setSigla(stripslashes($rs['uf']));

            $lista->append($novo);
        }
        return $lista;
    }

    //abrir idestado por cidade
    public function abrirIdEstado($id) {
        $query = sprintf("SELECT idEstado FROM cidade WHERE idCidade = '%s'", $id);

        //iniciar conexao
        $daoConexao = new conexaoDAO();
        $conexaoAberta = $daoConexao->conectar();

        //selecionar banco
        $daoConexao->selecionarBanco();

        //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
        $rs = $daoConexao->executeQuery($query);

        //fecha conexao
        $daoConexao->desconectar($conexaoAberta);

        //Setando valores
        $cidade = new Cidade();

        while ($resultado = mysql_fetch_array($rs)) {
            $cidade->setIdEstado(stripslashes($resultado['idEstado']));
            return $cidade;
        }
    }

}

?>
