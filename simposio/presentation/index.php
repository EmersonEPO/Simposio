<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?php
    //resolver problemas relacionado a acentuuação
    header("Content-Type: text/html; charset=ISO-8859-1", true);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" type="text/css" href="style/reset.css" >
        <link rel="stylesheet" type="text/css" href="style/style.css" >
        
        <title>Login</title>
    </head>
    <body>
        <!-- div menu login ou novo usuario -->
        <div class="divConteudo">
            <div class="divMenu">
                <a href="index.php?pag=frmLogin.php">
                    <input type="button" value="Login" class="botaoLogin">
                </a>
                <a href="index.php?pag=frmCadPessoa.php">
                    <input type="button" value="Registrar" class="botaoRegistrar">
                </a>
            </div>
            <img src="image/background.png" class="imgIfnmg"/>
            
            <!-- conteudo ficara aqui -->
            <?php
                //Com isso todas as paginas que forem chamadas serão aberta em main
                if(isset($_GET["pag"])){
                    include $_GET["pag"];
                }
            ?>
            <!-- fim -->
            
            
            <!-- div rodape -->
            <div class="divRodape">
                
            </div
        </div>
           <?php
                if(isset($_GET['erro'])){
                    echo"<script language='javascript'> 
                            alert('EMAIL ou SENHA incorretos!') 
                            window.location.href='../Presentation/index.php?pag=frmLogin.php'
                         </script>";
                    unset($_GET['erro']);

                }else{

                }
            ?>
    </body>
</html>
