<?php
//A sessao precisa ser iniciada caso ela nao exista
//para ser feito a comparação log mais
if (!isset($_SESSION)) {
    session_start();
}

//Se o cokie criado apos o login não existir mais
//significa que a sessao deve ser finalizada
if (!isset($_COOKIE['expira'])) {
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
$nivel_necessario = 2;
// Verifica se não há a variavel da sessao que identifica o usuario
if (!isset($_SESSION['email']) OR ($_SESSION['nivel'] < $nivel_necessario)) {
    //destroi a sessao por segurança
    session_destroy();
    //redireciona o visitante de volta pro login
    header("Location: ../presentation/index.php?pag=frmLogin.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

        <style type="text/css" media="all">
            @import url(style/reset.css);
            @import url(style/base.css);
            @import url(style/font.css);
            @import url(style/style.css);

        </style>
        <script type="text/javascript">
            function valida(){
                if(document.formEditLogin.senha.value != document.formEditLogin.confirmarSenha.value ){
                    alert("As senhas Estão incorretas")
                    document.formEditLogin.senha.focus()
                    document.formEditLogin.senha.value = ""
                    document.formEditLogin.confirmarSenha.value = ""
                    return false;
                }
            }
        </script>
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
            <form name="formEditLogin" id="formEditLogin" action="../controller/CtlPessoaEditar.php?at&ad" method="POST" name="login" id="login" >
                <label for="email" class="labelRegistrar">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $p->getEmail(); ?>"  class="forRegistrarLog" disabled="true"/>

                <br/>
                <label for="senha" class="labelRegistrar">Nova senha:</label>
                <input type="password" id="senha" name="senha" value="" required="" class="forRegistrarLog" maxlength="16" placeholder="Nova senha"/>

                <br/>
                <label for="confirmarSenha" class="labelRegistrar">Confirmar senha:</label>
                <input type="password" id="confirmarSenha" name="confirmarSenha" value="" required="" class="forRegistrarLog" maxlength="16" placeholder="Digite novamente" onblur="valida();"/>
                <br/>
                <input type="submit" name="atualizar" id="atualizar" value="Atualizar"  class="botaoAtualizarSenha">

            </form>
        </fieldset>
    </body>
</html>
