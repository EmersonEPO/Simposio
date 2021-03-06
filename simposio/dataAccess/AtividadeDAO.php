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
    //inserir
    public function inserir(Atividade $obj) {
        $query = sprintf("INSERT INTO atividade(fk_evento,fk_tipoAtv,fk_ministrante,nome,tipoDuracao,duracao,local,dataAtvidade,horaInicio,horaTermino,status) 
        VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',1)", $obj->getFk_evento(), $obj->getFk_tipoAtv(), $obj->getFk_ministrante(), $obj->getNome(), $obj->getTipoDuracao(), $obj->getDuracao(), $obj->getLocal(), $obj->getDataAtividade(), $obj->getHoraInicio(), $obj->getHoraTermino());
        //query para acrescentar estoque a uma atividade;
        $query_estoque = ("INSERT INTO controle(fk_atividade,totalVaga,totalEspera,status) VALUES(LAST_INSERT_ID(),30,5,1)");
        //iniciar conexao
        $daoConexao = new conexaoDAO();
        $conexaoAberta = $daoConexao->conectar();

        //selecionar banco
        $daoConexao->selecionarBanco();

        //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
        $daoConexao->executeQuery($query);
        $daoConexao->executeQuery($query_estoque);

        //fecha conexao
        $daoConexao->desconectar($conexaoAberta);
    }

    //atualizar
    public function atualizar(Atividade $obj) {
        $query = sprintf("UPDATE atividade SET fk_evento='%s',fk_tipoAtv='%s',fk_ministrante='%s',nome='%s',tipoDuracao='%s',duracao='%s',totalVaga='%s',local='%s',estoque='%s',dataAtvidade='%s',horaInicio='%s',horaTermino='%s' WHERE idAtividade = '%s' ", $obj->getFk_evento(), $obj->getFk_tipoAtv(), $obj->getFk_ministrante(), $obj->getNome(), $obj->getTipoDuracao(), $obj->getDuracao(), $obj->getLocal(), $obj->getDataAtividade(), $obj->getHoraInicio(), $obj->getHoraTermino(), $obj->getId());

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
        $query = sprintf("SELECT a.idAtividade,a.fk_evento,a.fk_tipoAtv,a.fk_ministrante,a.nome,a.tipoDuracao,a.duracao,a.local,a.dataAtividade,a.horaInicio,a.horaTermino FROM atividade a INNER JOIN evento e on (a.fk_evento = e.idEvento) WHERE (idAtividade = '%s' AND(a.status = 1 AND  e.status = 1))", $id);

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

            $novo = new Atividade();

            $novo->setId(stripslashes($rs['idAtividade']));
            $novo->setNome(stripslashes($rs['nome']));
            $novo->setTipoDucacao(stripslashes($rs['tipoDuracao']));
            $novo->setDuracao(stripslashes($rs['duracao']));
            $novo->setDataAtividade(implode("/", array_reverse(explode("-", $rs['dataAtividade']))));
            $novo->setHoraInicio(stripslashes($rs['horaInicio']));
            $novo->setHoraTermino(stripslashes($rs['horaTermino']));
            $novo->setLocal(stripslashes($rs['local']));
            $novo->setFk_evento(stripslashes($rs['fk_evento']));
            $novo->setFk_ministrante(stripslashes($rs['fk_ministrante']));
            $novo->setFk_tipoAtv(stripslashes($rs['fk_tipoAtv']));

            return $novo;
        }
    }

    //apagar
    public function apagar($id) {
        $query = sprintf("UPDATE atividade SET status = 0 WHERE idAtividade = '%s'", $id);

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

    //Listar todos
    public function listaTodos() {
        $query = "SELECT a.idAtividade,a.fk_evento,a.fk_tipoAtv,a.fk_ministrante,a.nome,a.tipoDuracao,a.duracao,a.local,a.dataAtividade,a.horaInicio,a.horaTermino FROM atividade a INNER JOIN evento e on (a.fk_evento = e.idEvento) WHERE (a.status = 1 AND  e.status = 1) ORDER BY a.horaInicio";

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
            $novo->setDataAtividade(implode("/", array_reverse(explode("-", $rs['dataAtividade']))));
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

    //listarTodos por data
    public function listaTodosPorData($data) {
        $query = "SELECT a.idAtividade,a.fk_evento,a.fk_tipoAtv,a.fk_ministrante,a.nome,a.tipoDuracao,a.duracao,a.local,a.dataAtividade,a.horaInicio,a.horaTermino FROM atividade a INNER JOIN evento e on (a.fk_evento = e.idEvento) WHERE ((a.status = 1 AND  e.status = 1)AND (a.dataAtividade like '" . $data . "' )) ORDER BY a.horaInicio";

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
            $novo->setDataAtividade(implode("/", array_reverse(explode("-", $rs['dataAtividade']))));
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

    //listarTodos do usuario
    public function listarAtividadeDoUser($id) {
        $query = "SELECT a.idAtividade,a.fk_evento,a.fk_tipoAtv,a.fk_ministrante,a.nome,a.tipoDuracao,a.duracao,a.local,a.dataAtividade,a.horaInicio,a.horaTermino 
                  FROM atividade a 
                  INNER JOIN matricula m ON (m.fk_atividade = a.idAtividade)
                  WHERE a.status = 1 AND  m.fk_pessoa = '" . $id . "'
                  ORDER BY a.nome";

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
            $novo->setDataAtividade(implode("/", array_reverse(explode("-", $rs['dataAtividade']))));
            $novo->setHoraInicio(stripslashes($rs['horaInicio']));
            $novo->setHoraTermino(stripslashes($rs['horaTermino']));
            $novo->setLocal(stripslashes($rs['local']));
            $novo->setFk_evento(stripslashes($rs['fk_evento']));
            $novo->setFk_ministrante(stripslashes($rs['fk_ministrante']));
            $novo->setFk_tipoAtv(stripslashes($rs['fk_tipoAtv']));

            $lista->append($novo);
        }
        if (count($lista)) {
            return $lista;
        } else {
            return null;
        }
    }

}
?>
