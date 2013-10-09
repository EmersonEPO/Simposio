<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
        
        ?>
        <fieldset class="loginFildesetOne">
            <legend>Já sou Cadastrado :</legend><br/>
            <form id="formLogin" method="POST" action="login.php">
                <label for="email" class="formLoginLabel">Email:</label>
                <input type="text" id="email" name="email" required="" class="formLogin"><br/>
                <label for="email" class="formLoginLabel">Senha:</label>
                <input type="password" id="senha" name="senha" required="" class="formLogin"><br/>
                <input type="submit" value="Entrar" class="botao">

            </form>
        </fieldset>
        <fieldset class="loginFildesetTwo">
            <legend>Não sou cadastrado :</legend><br/><br/><br/><br/>
            <form id="formCad" method="POST" action="index.php?pag=frmCadastro.php">
                <label for="email" class="formLoginLabel">Email:</label>
                <input type="text" id="email" name="email" required="" class="formLogin"><br/>
                <input type="submit" value="Entrar" class="botao">

            </form>
        </fieldset>
        
    </body>
</html>
