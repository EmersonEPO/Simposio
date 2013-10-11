<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

        <style type="text/css" media="all">
            @import url(style/reset.css);
            @import url(style/base.css);
            @import url(style/font.css);
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
                <input type="text" id="email" name="email" placeholder="joao@email.com" required="" class="formLogin"><br/>
                <label for="email" class="formLoginLabel">Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Digite a senha" required="" class="formLogin"><br/>
                <input type="submit" value="Entrar" class="botao">

            </form>
        </fieldset>
        <fieldset class="loginFildesetTwo">
            <legend>Não sou cadastrado :</legend><br/><br/><br/><br/>
            <form id="formCad" method="POST" action="index.php?pag=frmCadastro.php">
                <label for="email" class="formLoginLabel">Email:</label>
                <input type="text" id="email" name="email" required="" placeholder="joao@email.com" class="formLogin"><br/>
                <input type="submit" value="Entrar" class="botao">

            </form>
        </fieldset>

    </body>
</html>
