<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/jquery.maskedinput.js" type="text/javascript"></script>
        <script src="validacao.js" type="text/javascript"></script>
        <title>Dados Pessoais</title>
        <!-- mascaras -->
        <script>
            jQuery(function($){
                   $("#nascimento").mask("99/99/9999");
                   $("#fone").mask("(99) 999-9999");
                   $("#cpf").mask("999.999.999-99");
            });
        </script>
</script>
            
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <fieldset class="fieldsetRegistrar">
            <legend>DADOS PESSOAIS </legend>
            <form id="formPessoa" name="formPessoa" method="POST" action="../controller/CtlPessaoCad">
                <label for="nome" class="labelRegistrar">Nome:</label>
                <input type="text" id="nome" name="nome" value="" required=""  class="forRegistrar"/><br/>
                <label for="cpf" class="labelRegistrar">Cpf:</label>
                <input type="text" id="cpf" name="cpf" value="" required="" class="forRegistrar" maxlength="11" onblur="$('#cpf').validacpf();"/>
                <?php
                    echo "Cpf invalido!";
                ?>
                <br/>
                <label for="nascimento" class="labelRegistrar">Data Nascimento:</label>
                <input type="text" id="nascimento" name="nascimento" value="" required="" class="forRegistrar"/>
                Data invalida!
                <br/>
                <label for="sexo" class="labelRegistrar">Sexo:</label>
                <select id="sexo" name="sexo" required="" class="forRegistrarSelec">
                    <option value="" selected="">Selecione</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select><br/>
                <label for="sexo" class="labelRegistrar">Instituição:</label>
                <select id="sexo" name="sexo" required="" class="forRegistrarSelec">
                    <option value="" selected="">Selecione</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select><br/>
                <label for="fone" class="labelRegistrar">Telefone:</label>
                <input type="text" id="fone" name="fone" value="" required="" class="forRegistrar"/><br/><br/>
                <fieldset>
                    <legend>ENDEREÇO</legend>
                        
                    <label for="rua" class="labelRegistrar">Endereço:</label>
                    <input type="text" id="nascimento" name="rua" value="" required="" class="forRegistrar"/><br/>
                    <label for="rua" class="labelRegistrar">Numero:</label>
                    <input type="text" id="numero" name="numero" value="" required="" class="forRegistrar"/><br/>
                    <label for="rua" class="labelRegistrar">Bairro:</label>
                    <input type="text" id="bairro" name="bairro" value="" required="" class="forRegistrar"/><br/>
                    <label for="complemento" class="labelRegistrar">Complemento:</label>
                    <input type="text" id="complemento" name="complemento" value="" class="forRegistrar"/><br/>

                    <label for="cidade" class="labelRegistrar">Estado:</label>
                    <select id="sexo" name="sexo" required="" class="forRegistrarSelec">
                        <option value="" selected="">Selecione</option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select><br/>
                    <label for="cidade" class="labelRegistrar">Cidade:</label>
                    <select id="sexo" name="sexo" required="" class="forRegistrarSelec">
                        <option value="" selected="">Selecione</option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </fieldset>
                
                <fieldset class="fieldsetRegistrarLog">
                    <legend>LOGIN</legend>
                    <label for="nascimento" class="labelRegistrar">Email:</label>
                    <input type="text" id="nascimento" name="nascimento" value="" required="" class="forRegistrarLog"/>
                    Email invalido!
                    <br/>
                    <label for="nascimento" class="labelRegistrar">Senha:</label>
                    <input type="text" id="nascimento" name="nascimento" value="" required="" class="forRegistrarLog"/>
                </fieldset>
                <input type="submit" value="Cadastrar" class="botaoCad">
                
            </form>
            
        </fieldset>
    </body>
</html>
