<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?php
//resolver problemas relacionado a acentuuação
header("Content-Type: text/html; charset=utf-8", true);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <script rel="stylesheet" type="text/javascript" src="js/spryEffects.js"></script>
        <script type="text/javascript" src="validacao/validacao.js"></script>
        <script language="javascript" src="validacao/funcoes.js"></script>
        <title>Dados Pessoais</title>

        <style type="text/css" media="all">
            @import url(style/reset.css);
            @import url(style/base.css);
            @import url(style/font.css);
            @import url(style/style.css);
        </style>

        <title>Login</title>
    </head>
    <body>
        <!-- div menu login ou novo usuario -->
        <div class="divConteudo">
            <div class="divMenu">

                <a href="index.php?pag=frmLogin.php" class="linkLogin">
                    Login
                </a>
                <a href="index.php?pag=frmCadastro.php" class="linkRegis">
                    Registrar
                </a>          
            </div>
            <img src="image/background.png" class="imgIfnmg"/>

            <!-- conteudo ficara aqui -->
            <?php
            //Com isso todas as paginas que forem chamadas serão aberta em main
            if (isset($_GET["pag"])) {
                include $_GET["pag"];
            }
            ?>
            <!-- fim -->


            <!-- div rodape -->
            <!--
            <div class="divRodape">
                
            </div
            -->
        </div>
        <?php
        //mensagem para o caso de email ou senha estarem incorretos no login
        if (isset($_GET['erro'])) {
            echo"<div id='mensagem' style='' class='errorLogin'>";
                    echo"<p>Email ou Senha inválidos!</p>";
                    echo"</div>";
            unset($_GET['erro']);
        }
        //mensagem para o caso de ja existir o cpf no sistema 
        if (isset($_GET['cpf'])) {
             echo"<div id='mensagem' style='' class='warningRegistro'>";
                    echo"<p>Atenção, este CPF já esta em uso no sistema!</p>";
                    echo"</div>";
            unset($_GET['cpf']);
        }
        //mensagem para o caso de ja existir o cpf no sistema 
        if (isset($_GET['email'])) {
            echo"<div id='mensagem' style='' class='warningRegistro'>";
                    echo"<p>Atenção, Este EMAIL já esta em uso no sistema!</p>";
                    echo"</div>";
            unset($_GET['email']);
        }
        if (isset($_GET['sucess'])) {
            echo"<div id='mensagem' style='' class='successLogin'>";
                    echo"<p>Parabéns, você já pode começar a utlizar o sistema, para isso faça login!</p>";
                    echo"</div>";
            unset($_GET['sucess']);
        }
        ?>
    </body>
</html>
