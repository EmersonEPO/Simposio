<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style/resetar.css" >
        <title>Usuario</title>
    </head>
    <body>
        <?php
        
        ?>
        <div>
            <fieldsetl>
                <legend>Usuario</legend>
                <form name="formUsuario" id="formUsuario" method="POST" action="../controller/CtlUsuario.php">
                    <label for="nick">Nickname:</label>
                    <input type="text" required name="nick" id="nick"><br/>
                    <!-- -->
                    <label for="email">Email:</label>
                    <input type="text" required name="email" id="email"><br/>
                    <!-- -->
                    <label for="senha">Senha:</label>
                    <input type="password" required name="senha" id="senha"><br/>

                    <input type="submit" name="cadastrar" id="cadastrar" value="Cadastrar">
                </form>
            </fieldset>
            
        </div>
    </body>
</html>
