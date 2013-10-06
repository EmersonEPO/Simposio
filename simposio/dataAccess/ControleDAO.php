<?php
    include_once "../dataAccess/ConexaoDAO.php";
    include_once "../domainModel/Controle.php";

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleDAO
 *
 * @author Home
 */
class ControleDAO {

    //put your code here
    //pegar total de vagas e esperas
    public function abrirtotal($idAtividade) {
        $query = sprintf("SELECT * FROM controle WHERE fk_atividade = '%s' FOR UPDATE", $idAtividade);

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
            $novo = new Controle();

            $novo->setId(stripslashes($rs['idControle']));
            $novo->setTotalVaga(stripslashes($rs['totalVaga']));
            $novo->setTotalEspera(stripslashes($rs['totalEspera']));
            $novo->setFk_atividade(stripslashes($rs['fk_atividade']));

            return $novo;
        }
    }
    //diminuir lista de vagas
    public function acrescentarVaga($idAtividade) {
        $query = sprintf("UPDATE controle SET totalVaga = totalVaga + 1 WHERE fk_atividade = '%s'", $idAtividade);

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
    //diminuir lista de espera
    public function acrescentarEspera($idAtividade) {
        $query = sprintf("UPDATE controle SET totalEspera = totalEspera + 1 WHERE fk_atividade = '%s'", $idAtividade);

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
    //controle de choque de horario
    public function acrescentarEspra($horaInicio,$horaTermino) {
        $query = "SELECT COUNT(idAtividade) AS ok FROM atividade WHERE (((horaInicio >= '".$horaInicio."') AND (horaInicio < '".$horaTermino."')) OR ((horaTermino >= '".$horaInicio."') AND (horaTermino <= '".$horaTermino."')))";

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
}

?>
