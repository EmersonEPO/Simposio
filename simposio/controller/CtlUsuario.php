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