
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
                    window.location.href='../index.php?pag=frmLogin.php'
              </script>";
        
    }
    //nivel para ter acesso a essa pagina
    $nivel_necessario = 2;
    // Verifica se não há a variavel da sessao que identifica o usuario
    if (!isset($_SESSION['email']) OR ($_SESSION['nivel'] < $nivel_necessario)){
        //destroi a sessao por segurança
        session_destroy();
        //redireciona o visitante de volta pro login
        header("Location: ../index.php?pag=frmLogin.php"); exit;
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            include_once "../domainModel/Pessoa.php";
            include_once "../dataAccess/PessoaDAO.php";

            //pessoa
            $daoP = new PessoaDAO();
            $p = new Pessoa();

            $idPessoa = $_SESSION['id'];
            $p = $daoP->abrir($idPessoa);
        ?>
        <fieldset class="fieldsetRegistrarLog2">
            <legend>LOGIN</legend>
            <form action="../controller/CtlPessoaEditar.php?at&ad" method="POST" name="login" id="login">
                <label for="nascimento" class="labelRegistrar">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $p->getEmail(); ?>" required="" class="forRegistrarLog"/>

                <br/>
                <label for="nascimento" class="labelRegistrar">Senha:</label>
                <input type="password" id="senha" name="senha" value="<?php echo $p->getSenha(); ?>" required="" class="forRegistrarLog2"/>
                <input type="submit" name="atualizar" id="atualizar" value="Atualizar"  class="botaoAtualizar2">
                    
            </form>
        </fieldset>
    </body>
</html>
