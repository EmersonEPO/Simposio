<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
            <form action="../controller/CtlPessoaEditar.php?at" method="POST" name="login" id="login">
                <label for="nascimento" class="labelRegistrar">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $p->getEmail(); ?>" required="" class="forRegistrarLog"/>

                <br/>
                <label for="nascimento" class="labelRegistrar">Senha:</label>
                <input type="password" id="senha" name="senha" value="<?php echo $p->getSenha(); ?>" required="" class="forRegistrarLog2"/>
                <input type="submit" name="atualizar" id="atualizar" value="Atualizar"  class="botaoAtualizar2">
                    
            </form>
        </fieldset>
    </body>
</html>
