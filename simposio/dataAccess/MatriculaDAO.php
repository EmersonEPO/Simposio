<?php
    include_once "../dataAccess/ConexaoDAO.php";

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MatriculaDAO
 *
 * @author Home
 */
class MatriculaDAO {

    //put your code here
    public function matricular($pessoa, $atividade, $tipo) {
        $query = sprintf("INSERT INTO matricula(fk_pessoa,fk_atividade,fk_tipo,status) VALUES('%s','%s','%s',1)", $pessoa, $atividade, $tipo);

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
