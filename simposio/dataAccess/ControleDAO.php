<?php

//A sessao precisa ser iniciada caso ela nao exista
//para ser feito a comparação log mais
if (!isset($_SESSION)) {
    session_start();
}
//nivel para ter acesso a essa pagina
$nivel_necessario = 1;
// Verifica se não há a variavel da sessao que identifica o usuario
if (!isset($_SESSION['email']) OR ($_SESSION['nivel'] < $nivel_necessario)) {
    //destroi a sessao por segurança
    session_destroy();
    //redireciona o visitante de volta pro login
    header("Location: ../presentation/index.php?pag=frmLogin.php");
    exit;
}
?>

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
        $query = sprintf("SELECT * FROM controle WHERE fk_atividade = '%s'", $idAtividade);

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
    public function acrescentarVaga($idPessoa, $idAtividade, $idtipo) {
        $query = sprintf("CALL sp_atualizaTotalVaga(%s,%s,%s)", $idPessoa, $idAtividade, $idtipo);

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
    public function acrescentarEspera($idPessoa, $idAtividade, $idtipo) {
        $query = sprintf("CALL sp_atualizaTotalEspera(%s,%s,%s)", $idPessoa, $idAtividade, $idtipo);

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
    public function choqueHorario($horaInicio, $horaTermino,$data, $pessoa) {
        $query = "SELECT COUNT(a.idAtividade) AS ok FROM atividade a INNER JOIN matricula m ON (m.fk_atividade = a.idAtividade) 
            WHERE ((((a.dataAtividade LIKE '".$data."') AND ((a.horaInicio >= '" . $horaInicio . "') AND (a.horaInicio < '" . $horaTermino . "'))) OR 
            ((a.dataAtividade LIKE '".$data."') AND ((a.horaTermino >= '" . $horaInicio . "') AND (a.horaTermino <= '" . $horaTermino . "')))) AND m.fk_pessoa = '" . $pessoa . "')";

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
        if ($query['ok'] != 0) {
            return true;
        } else {
            return false;
        }
    }

}
?>
