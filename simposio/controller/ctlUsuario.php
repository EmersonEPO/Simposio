<?php
    include_once "../domainModel/Usuario.php";
    include_once "../dataAccess/usuarioDAO.php";
    
    
    //recebendo os dados via post
    $nome = ($_POST["nick"]);
    $email = ($_POST["email"]);
    $senha = ($_POST["senha"]);
    
    //armazeno os dadps em um cokie para que possa efetuar login automaticamente
    setcookie("email_user",$email, time() + 30);
    setcookie("senha_user",$senha, time() + 30);
    
    //instanciando
    $dao = new usuarioDAO();
    $usuario = new Usuario();
    
    //setando dados
    $usuario->setUsuario($nome);
    $usuario->setEmail($email);
    $usuario->setSenha($senha);
    
    //persistindo dados na dao
    if(!$dao->inserir($usuario)){
        
        echo"<script language='javascript'> 
                alert('Salvo com sucesso!') 
                window.location.href='../presentation/login.php?ok=1'
             </script>";
    }else{
        echo"<script language='javascript'> 
                alert('Ocorreu um erro!') 
                window.location.href='../Presentation/index.php'
             </script>"; 
    }
?>