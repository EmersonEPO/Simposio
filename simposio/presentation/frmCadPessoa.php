<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?php
    //Listar todas as instituições, estados, cidade, colocando cada lista em seus respectivos select.
    include_once "../dataAccess/InstituicaoDAO.php";
    include_once "../domainModel/Instituicao.php";
    include_once "../dataAccess/EstadoDAO.php";
    include_once "../domainModel/Estado.php";
   
    //Instituição
    $daoI = new InstituicaoDAO();
    $instituicao = new Instituicao();
    $instituicao = $daoI->listarTodos();
    //-----
    
    //Estado
    $daoE = new EstadoDAO();
    $estado = new Estado();
    $estado = $daoE->listarTodos();
    //-----


?>
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
                   $("#cpf").mask("999.999.999-99");
                   $("#nascimento").mask("99/99/9999");
                   $("#fone").mask("(99) 9999-9999");
            });
          
        </script>
        <script type="text/javascript">
            //ao selecionar estado o select de cidade so contera cidades pertendentes ao estado selecionado
                 function buscarCidades(){
                     var estado = $('#estado').val();
                     if(estado){
                         var url = '../controller/CtlCidadeAjax.php?estado='+estado;
                         $.get(url, function(dataReturn) {
                             $('#loadcidades').html(dataReturn);
                         });
                     }
                }    
        </script>
        <script type="text/javascript">
            function ativar(){
                if (document.getElementById("instituicao").value == 1)
                {
                    document.getElementById("novaIns").style.display="inline"
                    document.getElementById("novaIns1").style.display="inline"
                }else
                {
                    document.getElementById("novaIns").style.display="none";
                    document.getElementById("novaIns1").style.display="none";
                }
            }
        </script>
            
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <fieldset class="fieldsetRegistrar">
            <legend>DADOS PESSOAIS </legend>
            <form id="formPessoa" name="formPessoa" method="POST" action="../controller/CtlPessoa.php">
                <label for="nome" class="labelRegistrar">Nome:</label>
                <input type="text" id="nome" name="nome" value="" required=""  class="forRegistrar"/><br/>
                <label for="cpf" class="labelRegistrar">Cpf:</label>
                <input type="text" id="cpf" name="cpf" value="" required="" class="forRegistrar" maxlength="11"/>
 
                <br/>
                <label for="nascimento" class="labelRegistrar">Data Nascimento:</label>
                <input type="text" id="nascimento" name="nascimento" value="" required="" class="forRegistrar"/>
            
                <br/>
                <label for="sexo" class="labelRegistrar">Sexo:</label>
                <select id="sexo" name="sexo" required="" class="forRegistrarSelec">
                    <option value="" selected="">Selecione</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select><br/>
                <label for="fone" class="labelRegistrar">Telefone:</label>
                <input type="text" id="fone" name="fone" value="" required="" class="forRegistrar"/><br/>
                <label for="instituicao" class="labelRegistrar">Instituição:</label>
                <select id="instituicao" name="instituicao" required="" class="forRegistrarSelec" onchange="ativar();">
                    <option value="" selected="">Selecione</option>
                    <option value="1" >OUTRO</option>
                    <?php
                        foreach ($instituicao as $in){
                            echo"<option value='".$in->getId()."'>".strtoupper($in->getNome())."</option>";
                            $in++;
                        }
                    ?>
                </select><br/>
                
                <label for="novaIns" class="labelRegistrar" id="novaIns1" style="display: none">Nome instituição:</label>
                <input type="text" id="novaIns" name="novaIns" value="" class="forRegistrar" style="display: none"/><br/><br/>
         
                <fieldset>
                    <legend>ENDEREÇO</legend>
                        
                    <label for="rua" class="labelRegistrar">Endereço:</label>
                    <input type="text" id="rua" name="rua" value="" required="" class="forRegistrar"/><br/>
                    <label for="rua" class="labelRegistrar">Numero:</label>
                    <input type="text" id="numero" name="numero" value="" required="" class="forRegistrar"/><br/>
                    <label for="rua" class="labelRegistrar">Bairro:</label>
                    <input type="text" id="bairro" name="bairro" value="" required="" class="forRegistrar"/><br/>
                    <label for="complemento" class="labelRegistrar">Complemento:</label>
                    <input type="text" id="complemento" name="complemento" value="" class="forRegistrar"/><br/>

                    <label for="cidade" class="labelRegistrar">Estado:</label>
                    <select id="estado" name="estado" required="" class="forRegistrarSelec" onchange="buscarCidades()">
                        <option value="" selected="">Selecione</option>
                        <?php
                            ini_set( 'default_charset', 'utf-8');
                            foreach ($estado as $es){
                                echo"<option value='".$es->getId()."'>".strtoupper($es->getNome())."</option>";
                                $es++;
                            }
                        ?>
                    </select><br/>
                    <div id="loadcidades">
                        <label for="cidade" class="labelRegistrar">Cidade:</label>
                        <select id="cidade" name="cidade" required="" class="forRegistrarSelec">
                            <option selected value="">Escolha um estado</option>
                        </select>
                    </div>
                </fieldset>
                
                <fieldset class="fieldsetRegistrarLog">
                    <legend>LOGIN</legend>
                    <label for="nascimento" class="labelRegistrar">Email:</label>
                    <input type="text" id="email" name="email" value="" required="" class="forRegistrarLog"/>
                  
                    <br/>
                    <label for="nascimento" class="labelRegistrar">Senha:</label>
                    <input type="password" id="senha" name="senha" value="" required="" class="forRegistrarLog"/>
                </fieldset>
                <input type="submit" value="Cadastrar" class="botaoCad">
                
            </form>
            
        </fieldset>
    </body>
</html>
