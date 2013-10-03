<?php
    include_once "../domainModel/Usuario.php";
    include_once "../dataAccess/UsuarioDAO.php";
    
    
    //recebendo os dados via post
    //$nome = ($_POST["nick"]);
    $email = ($_POST["email"]);
    $senha = ($_POST["senha"]);
    
    //instanciando
    $dao = new usuarioDAO();
    $usuario = new Usuario();
    
    //setando dados
    //$usuario->setUsuario($nome);
    $usuario->setEmail($email);
    $usuario->setSenha($senha);
    
    //verificando de usuario já exite no banco
    //verifica se email ja existe no sistema!
    if (($dao->verificarEmail($email)) == true) {
    echo"<script language='javascript'> 
              window.location.href='../presentation/index.php?erro'
             </script>";
    } else {
        //armazeno os dadps em um cokie para que possa efetuar login automaticamente
        setcookie("email_user", $email, time() + 30);
        setcookie("senha_user", $senha, time() + 30);

        //persistindo dados na dao
        if (!$dao->inserir($usuario)) {

            echo"<script language='javascript'> 
                            window.location.href='../presentation/login.php?ok=1'
                         </script>";
        } else {
            echo"<script language='javascript'> 
                            alert('Ocorreu um erro!') 
                            window.location.href='../Presentation/index.php'
                         </script>";
        }
    }
?>