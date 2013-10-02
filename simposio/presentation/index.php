<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="style/reset.css" >
        <link rel="stylesheet" type="text/css" href="style/styleLogin.css" >
        
        <title>Login</title>
    </head>
    <body>
     
        <div class="divlogin">
            <span class="titulo">IF</span>
            <form name="login" id="login" method="POST" action="login.php">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="" required >
                <!-- informa senha -->
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" value="" required >
       
                <!-- botao entrar -->
                <input type="submit" id="entrar" name="entrar" value="Entrar">
            </form>
        </div>
        <!-- div novo usuario -->
        <div class="conteudo">
            <span class="">Cadastre-se</span><br/>
            <form name="formUsuario" id="formUsuario" method="POST" action="../controller/CtlUsuario.php">
                <label for="nick">Nome:</label>
                <input type="text" required name="nick" id="nick" class="novoUser"><br/>
                <!-- -->
                <label for="email">Email:</label>
                <input type="text" required name="email" id="email" class="novoUser"><br/>
                <!-- -->
                <label for="senha">Senha:</label>
                <input type="password" required name="senha" id="senha" class="novoUser"><br/>

                <input type="submit" name="cadastrar" id="cadastrar" value="Cadastrar" class="salvarUser">
            </form>

        </div>
    </body>
       <?php
            //mensagem informando que usuario ou email já existe no sistema!
            if(!isset($_GET['erro'])){
                //se erro nao existir, nada será feito
            }else{
                //mensagem para usuario
                if(($_GET['erro'])== 0){
                    echo "<script type='text/javascript'> alert('Usuario ja existe!')</script>";
                }
           
                if(($_GET['erro']) == 1){
                    echo "<script type='text/javascript'> alert('Email ja existe!')</script>";
                }
            }
            
        ?>
</html>
