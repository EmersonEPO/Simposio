<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <style type="text/css" media="all">
            @import url(style/reset.css);
            @import url(style/base.css);
            @import url(style/font.css);
            @import url(style/style.css);

        </style>
        <script type="text/javascript">
            function valida(){
                if(document.frmEditLogin.senha.value != document.frmEditLogin.confirmarSenha.value ){
                    alert("As senhas Estão incorretas")
                    document.frmEditLogin.senha.focus()
                    document.frmEditLogin.senha.value = ""
                    document.frmEditLogin.confirmarSenha.value = ""
                    return false;
                }else if(document.frmEditLogin.funcionario.value == 0){
                    alert("Selecione um Funcionário");
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
            <form name="formEditLogin" id="formEditLogin" action="../controller/CtlPessoaEditar.php?at" method="POST" name="login" id="login" onsubmit="return valida(this);">
                <label for="nascimento" class="labelRegistrar">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $p->getEmail(); ?>"  class="forRegistrarLog" disabled="true"/>
                <br/>
                <label for="nascimento" class="labelRegistrar">Senha antiga:</label>
                <input type="password" id="senhaAntiga" name="senhaAntiga" value="" required="" class="forRegistrarLog" maxlength="16" placeholder="Senha antiga"/>
                
                <br/>
                <label for="nascimento" class="labelRegistrar">Nova senha:</label>
                <input type="password" id="senha" name="senha" value="" required="" class="forRegistrarLog" maxlength="16" placeholder="Nova senha"/>
                
                <br/>
                <label for="nascimento" class="labelRegistrar">Confirmar senha:</label>
                <input type="password" id="confirmarSenha" name="confirmarSenha" value="" required="" class="forRegistrarLog" maxlength="16" placeholder="Digite novamente"/>
                <br/>
                <input type="submit" name="atualizar" id="atualizar" value="Atualizar"  class="botaoAtualizarSenha">
                    
            </form>
        </fieldset>
    </body>
</html>
