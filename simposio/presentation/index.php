<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style/resetar.css" >
        <link rel="stylesheet" type="text/css" href="style/styleLogin.css" >
        <link rel="stylesheet" type="text/css" href="style/animacaoLogin.css" >
        <title>Login</title>
    </head>
    <body>
        <?php
            include_once "../dataAccess/connection.php";
        ?>
        <div id="container">
            <form name="login" id="login" method="POST" action="login.php">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="" required ><br/>
                <!-- informa senha -->
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" value="" required ><br/>
                <!-- Registrar -->
                <span class="registrar">Não é registrado?</span> 
                <a href="frmCadUsuario.php" class="cliqueaqui">Clique aqui!</a>
                <div id="lower">
                    <!-- botao entrar -->
                    <input type="submit" id="entrar" name="entrar" value="Entrar">
                </div>
            </form>
        </div>
    </body>
</html>
