<?php
    include_once "../dataAccess/connection.php";
    include_once "../domainModel/Usuario.php";
    include_once "../dataAccess/UsuarioDAO.php";
    
    //recebendo os dados via post
    $nome = ($_POST["nick"]);
    $email = ($_POST["email"]);
    $senha = ($_POST["senha"]);
    
    //criando objetos
    $dao = new UsuarioDAO();
    $usuario = new Usuario();
    
    //setando dados
    $usuario->setUsuario($nome);
    $usuario->etEmail($email);
    $usuario->setSenha($senha);
    
    //persistindo dados na dao
    if(!$dao->inserir($usuario)){
        echo"<script language='javascript'> 
                alert('Salvo com sucesso!') 
                window.location.href='../Presentation/login.php'
             </script>";
    }else{
        echo"<script language='javascript'> 
                alert('Ocorreu um erro!') 
                window.location.href='../Presentation/main.php?pagina=frmCadUsuario.php'
             </script>"; 
    }
?>