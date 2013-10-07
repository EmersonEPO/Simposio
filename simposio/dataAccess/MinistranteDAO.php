<?php
    //A sessao precisa ser iniciada caso ela nao exista
    //para ser feito a comparação log mais
    if (!isset($_SESSION)) {
        session_start();
    }

    //Se o cokie criado apos o login não existir mais
    //significa que a sessao deve ser finalizada
    if(!isset($_COOKIE['expira'])){
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
    if (!isset($_SESSION['email']) OR ($_SESSION['nivel'] < $nivel_necessario)){
        //destroi a sessao por segurança
        session_destroy();
        //redireciona o visitante de volta pro login
        header("Location: ../presentation/index.php?pag=frmLogin.php"); exit;
    }
    
?>

<?php
    include_once "../dataAccess/ConexaoDAO.php";
    include_once "../domainModel/Ministrante.php";

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MinistranteDAO
 *
 * @author Home
 */
class MinistranteDAO {
    //put your code here
    //inserir
    public function inserir(Ministrante $obj){
        $query = sprintf("INSERT INTO ministrante(nome,formacao,status) VALUES('%s','%s',1)",$obj->getNome(),$obj->getFormacao());
        
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
    public function atualizar(Ministrante $obj){
        $query = sprintf("UPDATE ministrante SET nome='%s',formacao='%s' WHERE idMinistrante = '%s'",$obj->getNome(),$obj->getFormacao(),$obj->getId());
        
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
        $query = sprintf("SELECT * from ministrante WHERE idMinistrante = '%s'",$id);
        
        //iniciar conexao
        $daoConexao = new conexaoDAO();
        $conexaoAberta = $daoConexao->conectar();

        //selecionar banco
        $daoConexao->selecionarBanco();

        //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
        $resultado = $daoConexao->executeQuery($query);

        //fecha conexao
        $daoConexao->desconectar($conexaoAberta);
        
        while ($rs = mysql_fetch_array($resultado)){
            $novo = new Ministrante();
            
            $novo->setId(stripslashes($rs['idMinistrante']));
            $novo->setNome(stripslashes($rs['nome']));
            $novo->setFormacao(stripslashes($rs['formacao']));
            return $novo;
        }  
    }
    //apagar
    public function apagar($id){
        $query = sprintf("UPDATE ministrante SET status = 0 WHERE idMinistrante = '%s'",$id);
        
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
    public function listarTodos(){
        $query = sprintf("SELECT * from ministrante WHERE status = 1");
        
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
        
        while ($rs = mysql_fetch_array($resultado)){
            $novo = new Ministrante();
            
            $novo->setId(stripslashes($rs['idMinistrante']));
            $novo->setNome(stripslashes($rs['nome']));
            $novo->setFormacao(stripslashes($rs['formacao']));
            $lista->append($novo);
        }  
        return $lista;
    }
}

?>
