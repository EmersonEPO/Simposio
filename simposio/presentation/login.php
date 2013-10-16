<?php

include_once "../dataAccess/ConexaoDAO.php";
include_once "../dataAccess/PessoaDAO.php";

//criar uma conexao com o banco
$dao = new conexaoDAO();
//criar uma conexao
$conexaoAberta = $dao->conectar();
//seleciona o banco
$dao->selecionarBanco();
//----

$email = mysql_real_escape_string($_POST['email']);
$senha = mysql_real_escape_string($_POST['senha']);

//selecionar o usuario
$sql = "SELECT * FROM pessoa WHERE '" . $email . "' = email AND '" . sha1($senha) . "' = senha LIMIT 1";
$query = $dao->executeQuery($sql);

//se a conexão apos realizar a consulta
$dao->desconectar($conexaoAberta);
//----

if (mysql_num_rows($query) != 1) {

    //senha e ou usuario invalido
    //redireciona para a tela de login
    header("Location: index.php?pag=frmLogin.php&erro");
    exit;
} else {

    //salva os dados encontados na variável $resultado
    $resultado = mysql_fetch_assoc($query);

    //limpa os dados contido na variavel $query
    mysql_free_result($query);

    //se a sessão não existir, inicia uma
    if (!isset($_SESSION)) {
        //inicia uma nova sessao
        session_start();
    }

    //Salva os dados encontrados na consulta sql dentro de uma sessão
    $_SESSION['id'] = $resultado['idPessoa'];
    $_SESSION['email'] = $resultado['email'];
    $_SESSION['nivel'] = $resultado['nivel'];

    //limpa os dados contido na variavel $resultado
    mysql_free_result($resultado);


    //redireciona
    if ($_SESSION['nivel'] == 1) {
        header("Location: main.php?pag=frmMinicurso.php&Qua");
    } else {
        header("Location: administrator.php");
    }
    exit;
}
?>

