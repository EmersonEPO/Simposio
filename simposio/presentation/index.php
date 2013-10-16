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
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

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
            echo"<script language='javascript'> 
                            alert('EMAIL ou SENHA incorretos!') 
                            window.location.href='../Presentation/index.php?pag=frmLogin.php'
                         </script>";
            unset($_GET['erro']);
        }
        //mensagem para o caso de ja existir o cpf no sistema 
        if (isset($_GET['cpf'])) {
            echo"<script language='javascript'> 
                            alert('CPF já consta no sistema!') 
                            window.location.href='../Presentation/index.php?pag=frmCadastro.php'
                         </script>";
            unset($_GET['cpf']);
        }
        //mensagem para o caso de ja existir o cpf no sistema 
        if (isset($_GET['email'])) {
            echo"<script language='javascript'> 
                            alert('EMAIL já consta no sistema!') 
                            window.location.href='../Presentation/index.php?pag=frmCadastro.php'
                         </script>";
            unset($_GET['cpf']);
        }
        if (isset($_GET['sucess'])) {
            echo"<script language='javascript'> 
                            alert('Você foi cadastrado com sucesso, faça login para utilizar o sistema!') 
                            window.location.href='../Presentation/index.php?pag=frmLogin.php'
                         </script>";
            unset($_GET['sucess']);
        }
        ?>
    </body>
</html>
