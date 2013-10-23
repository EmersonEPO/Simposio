<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php
	//header("Content-Type: text/html; charset=iso-8859-1",true); 
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
        <title></title>
    </head>
    <body>
        <?php
        ?>
        <fieldset class="loginFildesetOne">
            <legend class="fildCssLegendLogin"><b>Já sou Cadastrado:</b></legend><br/>
            <form id="formLogin" method="POST" action="login.php">
                <label for="email" class="formLoginLabel">E-mail:</label>
                <input type="text" id="email" name="email" placeholder="joao@email.com" value="" class="formLogin">
                <label for="email" class="formLoginLabel">Senha:</label>
                <input type="password" id="senha" name="senha" placeholder="Digite a senha" class="formLogin">
                <input type="submit" value="Entrar" class="botao">

            </form>
        </fieldset>
        <fieldset class="loginFildesetTwo">
            <legend class="fildCssLegendLogin"><b>Não sou cadastrado:</b></legend><br/>
            <form id="formCad" name="formCad" method="POST" action="index.php?pag=frmCadastro.php">
                <label for="email2" class="formLoginLabel">E-mail:</label>
                <input type="text" id="email2" name="email2" value="" placeholder="joao@email.com" class="formLogin"><br/>
                <input type="submit" value="Entrar" class="botao">

            </form>
        </fieldset>
        
    </body>
</html>
