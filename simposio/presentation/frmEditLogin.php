<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css" media="all">
            @include url('http://yui.yahooapis.com/3.5.0/build/cssreset/cssreset-min.css');
            @include url('http://yui.yahooapis.com/3.5.0/build/cssbase/cssbase-min.css');
            @include url('http://yui.yahooapis.com/3.5.0/build/cssfonts/cssfonts-min.css');
            @import url(style/style.css);
        </style>
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
            <form name="formEditLogin" id="formEditLogin" onsubmit="" action="../controller/CtlPessoaEditar.php?at" method="POST" name="login" id="login">
                <label for="nascimento" class="labelRegistrar">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $p->getEmail(); ?>"  class="forRegistrarLog" disabled="true"/>
                <br/>
                <label for="nascimento" class="labelRegistrar">Senha antiga:</label>
                <input type="password" id="senha" name="senha" value="" required="" class="forRegistrarLog" maxlength="16"/>
                
                <br/>
                <label for="nascimento" class="labelRegistrar">Nova senha:</label>
                <input type="password" id="senha" name="senha" value="" required="" class="forRegistrarLog" maxlength="16"/>
                
                <br/>
                <label for="nascimento" class="labelRegistrar">Confirmar senha:</label>
                <input type="password" id="senha" name="senha" value="" required="" class="forRegistrarLog" maxlength="16"/>
                <br/>
                <input type="submit" name="atualizar" id="atualizar" value="Atualizar"  class="botaoAtualizar">
                    
            </form>
        </fieldset>
    </body>
</html>
