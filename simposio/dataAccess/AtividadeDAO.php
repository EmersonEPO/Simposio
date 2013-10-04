<?php
    include_once "../dataAccess/ConexaoDAO.php";
    include_once "../domainModel/Atividade.php";

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AtividadeDAO
 *
 * @author Home
 */
class AtividadeDAO {
    //put your code here
    public function listaTodos() {
        $query = "SELECT * FROM atividade INNER JOIN evento on (atividade.fk_evento = evento.idEvento) WHERE atividade.status = 1 AND  evento.status = 1";

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

            $novo = new Atividade();

            $novo->setId(stripslashes($rs['idAtividade']));
            $novo->setNome(stripslashes($rs['nome']));
            $novo->setTipoDucacao(stripslashes($rs['tipoDuracao']));
            $novo->setDuracao(stripslashes($rs['duracao']));
            $novo->setTotalVaga(stripslashes($rs['totalVaga']));
            $novo->setEstoque(stripslashes($rs['estoque']));
           // $novo->setDataAtividade(implode("/", array_reverse(explode("-", $rs['dataAtividade']))));
            $novo->setHoraInicio(stripslashes($rs['horaInicio']));
            $novo->setHoraTermino(stripslashes($rs['horaTermino']));
            $novo->setLocal(stripslashes($rs['local']));
            $novo->setFk_evento(stripslashes($rs['fk_evento']));
            $novo->setFk_ministrante(stripslashes($rs['fk_ministrante']));
            $novo->setFk_tipoAtv(stripslashes($rs['fk_tipoAtv']));

            $lista->append($novo);
        }
        return $lista;
    }

}

?>
