<?php
    include_once "../domainModel/Usuario.php";
    include_once "../dataAccess/usuarioDAO.php";
    
    
    //recebendo os dados via post
    $nome = ($_POST["nick"]);
    $email = ($_POST["email"]);
    $senha = ($_POST["senha"]);
    
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
                window.location.href='../presentation/login.php?ok=0'
             </script>";
    }else{
        echo"<script language='javascript'> 
                alert('Ocorreu um erro!') 
                window.location.href='../Presentation/main.php?pagina=frmCadUsuario.php'
             </script>"; 
    }
?>