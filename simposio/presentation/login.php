<?php

    include_once "../dataAccess/conexaoDAO.php";
    include_once "../dataAccess/usuarioDAO.php";

    //criar uma conexao com o banco
    $dao = new conexaoDAO();
    //criar uma conexao
    $conexaoAberta = $dao->conectar();
    //seleciona o banco
    $dao->selecionarBanco();
    //----

    //pegar cokie para efetuar login automaticamente (somente na hora q um user é criado)
    if (isset($_GET["ok"])) {

        $email = $_COOKIE['email_user'];
        $senha = $_COOKIE['senha_user'];

        //destruindo cokie por segurança
        setcookie("nome");
        setcookie("senha");
    } else {
    
        $email = mysql_real_escape_string($_POST['email']);
        $senha = mysql_real_escape_string($_POST['senha']);
    }

    //selecionar o usuario
    $sql = "SELECT * FROM usuario WHERE '" . $email . "' = email AND '" . $senha . "' = senha LIMIT 1";
    $query = $dao->executeQuery($sql);

    //se a conexão apos realizar a consulta
    $dao->desconectar($conexaoAberta);
    //----
    
    if (mysql_num_rows($query) != 1) {
    
        //senha e usuario invalido
        //redireciona para a tela de login
        header("Location: index.php");
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
            //criar um cokie para indicar se a sessao deve ser finalizada
            setcookie("expira", 0, (time() + 3600));
            //-----
        }
          
            //Salva os dados encontrados na consulta sql dentro de uma sessão
            $_SESSION['id'] = $resultado['idUsuario'];
            $_SESSION['email'] = $resultado['email'];
            $_SESSION['nivel'] = $resultado['nivel'];
            $_SESSION['nome'] = $resultado['nome'];

            //limpa os dados contido na variavel $resultado
            mysql_free_result($resultado);

            $user = new usuarioDAO();
            $id = $_SESSION['id'];
            
            //verifico aqui se o usuario já tem dados cadastrados no sistema, 
            //caso nao tenha ele será obrigado a entra em uma tela se cadastro de dados pessoais. 
            if(!$user->verificarRegistros($id)){
                header("Location: save/frmPessoa.php");
                exit;
            }else{
                //redireciona
                header("Location: main.php");
                exit;
            }

    }
?>

