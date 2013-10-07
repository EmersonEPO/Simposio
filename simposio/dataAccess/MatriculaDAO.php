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
        //verifica a quantidade de matricula que um aluno fez
        public function totalMatricula($max,$pessoa){
            $query = sprintf("SELECT COUNT(fk_pessoa) as totalMatriculas FROM matricula WHERE fk_pessoa = '%s'",$pessoa);

            //iniciar conexao
            $daoConexao = new conexaoDAO();
            $conexaoAberta = $daoConexao->conectar();

            //selecionar banco
            $daoConexao->selecionarBanco();

            //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
            $resultado = $daoConexao->executeQuery($query);

            //fecha conexao
            $daoConexao->desconectar($conexaoAberta);
            
            $matriculas = mysql_fetch_array($resultado);
            
            if($matriculas['totalMatriculas'] < $max){
                return true;
            }else{
                return false;
            }
        }
        //verifica a quantidade de matricula que um aluno fez
        public function existteMatricula($pessoa){
            $query = sprintf("SELECT COUNT(fk_pessoa) as totalMatriculas FROM matricula WHERE fk_pessoa = '%s'",$pessoa);

            //iniciar conexao
            $daoConexao = new conexaoDAO();
            $conexaoAberta = $daoConexao->conectar();

            //selecionar banco
            $daoConexao->selecionarBanco();

            //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
            $resultado = $daoConexao->executeQuery($query);

            //fecha conexao
            $daoConexao->desconectar($conexaoAberta);
            
            $matriculas = mysql_fetch_array($resultado);
            
            if($matriculas['totalMatriculas'] != 0){
                return true;
            }else{
                return false;
            }
        }
        
}

?>
