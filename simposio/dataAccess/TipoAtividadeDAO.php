<?php

//A sessao precisa ser iniciada caso ela nao exista
//para ser feito a comparação log mais
if (!isset($_SESSION)) {
    session_start();
}

//Se o cokie criado apos o login não existir mais
//significa que a sessao deve ser finalizada
if (!isset($_COOKIE['expira'])) {
    //detroi sessao
    session_destroy();
    //por segurança, estou destruindo também o cokie
    setcookie("expira");
    //mensagem informando que o tempo do usuario expirou, redireciona para index
    echo "<script language='javascript'>
                    window.location.href='../presentation/index.php?pag=frmLogin.php'
              </script>";
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
    public function inserir(TipoAtividade $obj) {
        $query = sprintf("INSERT INTO tipoatividade(status,nome) VALUES('%s',1)", $obj->getNome());

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
    public function atualizar(TipoAtividade $obj) {
        $query = sprintf("UPDATE tipoatividade SET nome='%s' WHERE idTipoAtv = '%s' ", $obj->getNome(), $obj->getId);

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
        $query = sprintf("SELECT * FROM tipoatividade WHERE idTipoAtv = '%s'", $id);

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
    public function apagar($id) {
        $query = sprintf("UPDATE tipoatividade SET status = 0 WHERE idTipoAtv = '%s'", $id);

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

    //Função auxiliar para procurar a chave estrangeira de matricula
    //Inscrito ou pre inscrito
    //Inscrito se 1
    //pre-inscrito se 2
    public function abrirMatricula($id, $pessoa) {
        $query = sprintf("SELECT * FROM matricula WHERE fk_atividade = '%s' and fk_pessoa = '%s'", $id, $pessoa);

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

            $novo->getId(stripslashes($rs['fk_tipo']));

            return $novo;
        }
    }

}
?>
