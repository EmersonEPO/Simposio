<?php
//A sessao precisa ser iniciada caso ela nao exista
//para ser feito a comparação log mais
if (!isset($_SESSION)) {
    session_start();
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
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script rel="stylesheet" type="text/javascript" src="js/spryEffects.js"></script>
        <script type="text/javascript" src="validacao/validacao.js"></script>
        <script language="javascript" src="validacao/funcoes.js"></script>
        <script type="text/javascript">
            function MM_effectAppearFade(targetElement, duration, from, to, toggle){
                Spry.Effect.DoFade(targetElement, {duration: duration, from: from, to: to, toggle: toggle});
            }
        </script>

        <style type="text/css" media="all">
            @import url(style/reset.css);
            @import url(style/base.css);
            @import url(style/font.css);
            @import url(style/style.css);

        </style>
        <script type="text/javascript">
            function valida(){
                if(document.formEditLogin.senha.value != document.formEditLogin.confirmarSenha.value ){
                    document.formEditLogin.senha.focus()
                    document.formEditLogin.senha.value = ""
                    document.formEditLogin.confirmarSenha.value = ""
                    var texto = "As senhas não são iguais"
                    MM_effectAppearFade('erroEditLogin',1000,0,100, false);
                    document.getElementById('erroEditLogin').innerHTML = texto;
                    return false;
                }else{
                    return true;  
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
            <form name="formEditLogin" id="formEditLogin" action="../controller/CtlPessoaEditar.php?ad" method="POST" name="formEditLogin" id="login" onsubmit="return validarLogin()">
                <label for="email" class="labelRegistrar">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $p->getEmail(); ?>"  class="forRegistrarLog" disabled="true"/>

                <br/>
                <label for="senha" class="labelRegistrar">Nova senha:</label>
                <input type="password" id="senha" name="senha" value="" class="forRegistrarLog" maxlength="16" placeholder="Nova senha"/>

                <br/>
                <label for="confirmarSenha" class="labelRegistrar">Confirmar senha:</label>
                <input type="password" id="confirmarSenha" name="confirmarSenha" value=""  class="forRegistrarLog" maxlength="16" placeholder="Digite novamente" onblur="valida();"/>
                <br/>
                <input type="submit" name="atualizar" id="atualizar" value="Atualizar"  class="botaoAtualizarSenha">

            </form>
        </fieldset>
        <div id="erroEditLogin" class="erroEditLogin"></div>
    </body>
    
</html>
