<?php
header("Content-Type: text/html; charset=iso-8859-1",true); 
?>
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
if (isset($_POST['email2'])) {
    $email = $_POST['email2'];
} else {
    $email = "";
}

?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script type="text/javascript" src="validacao/validacao.js"></script>
        <script language="javascript" src="validacao/funcoes.js"></script>
        <script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.maskedinput.js"></script>
	
        <title>Dados Pessoais</title>
        <script type="text/javascript">
            function MM_effectAppearFade(targetElement, duration, from, to, toggle){
                Spry.Effect.DoFade(targetElement, {duration: duration, from: from, to: to, toggle: toggle});
            }
        </script>
         <script type="text/javascript">
            function validar(dados){
                if(!checkCpf(dados.cpf)) return false;
            }    
        </script>
        
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
        <script type="text/javascript">
            function valida(){
                if(document.formPessoa.senha.value != document.formPessoa.primeiraSenha.value ){
                    document.formPessoa.senha.focus()
                    document.formPessoa.senha.value = ""
                    document.formPessoa.primeiraSenha.value = ""
                    var texto = "As senhas não são iguais"
                    MM_effectAppearFade('erro',1000,0,100, false);
                    document.getElementById('erro').innerHTML = texto;
                    return false;
                }else{
                    return true;  
                }
            }
        </script>

    </head>
    <body>
        <?php
        // put your code here
        ?>
        <fieldset class="fieldsetRegistrar">
            <legend class="fildCssLegend" ><b>DADOS PESSOAIS</b> </legend><br/><br/>
            <!--   <form id="formPessoa" name="formPessoa" method="POST" action="teste.php" onsubmit="return validaPessoa()"> -->
            <form id="formPessoa" name="formPessoa" method="POST" action="../controller/CtlPessoa.php" onsubmit="return validaPessoa()"> 
                <label for="nome" class="labelRegistrar">NOME:</label>
                <input type="text" id="nome" name="nome" value=""  placeholder="Pedro"  class="forRegistrar"/><br/>
                <label for="cpf" class="labelRegistrar">CPF:</label>
                <input type="text" id="cpf" name="cpf" value="" placeholder="111.111.111-11" class="forRegistrar" onblur="validar(document.formPessoa)" maxlength="14"/>

                <br/>
                <label for="nascimento" class="labelRegistrar">DATA DE NASCIMENTO:</label>
                <input type="text" id="nascimento" name="nascimento" value="" placeholder="00/00/0000"  class="forRegistrar"/>

                <br/>
                <label for="sexo" class="labelRegistrar">SEXO:</label>
                <select id="sexo" name="sexo"  class="forRegistrarSelec">
                    <option value="" selected="">Selecione</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select><br/>
                <label for="fone" class="labelRegistrar">TELEFONE:</label>
                <input type="text" id="fone" name="fone" value="" placeholder="(00) 0000-0000" class="forRegistrar"/><br/>
                <label for="instituicao" class="labelRegistrar"><img src="../presentation/image/instituicao.png"></label>
                <select id="instituicao" name="instituicao"  class="forRegistrarSelec" onchange="ativar();">
                    <option value="" selected="">Selecione</option>
                    <option value="1" >OUTRO</option>
                    <?php
                    foreach ($instituicao as $in) {
                        echo"<option value='" . $in->getId() . "'>" . strtoupper($in->getNome()) . "</option>";
                        $in++;
                    }
                    ?>
                </select><br/>

                <label for="novaIns" class="labelRegistrar" id="novaIns1" style="display: none"><img src="../presentation/image/nome_ins.png"></label>
                <input type="text" id="novaIns" name="novaIns" value="" class="forRegistrar" placeholder="Nome da Inst." style="display: none"/>

                <fieldset>

                    <label for="rua" class="labelRegistrar"><img src="../presentation/image/endereco.png"></label>
                    <input type="text" id="rua" name="rua" value="" placeholder="Rua" class="forRegistrar"/><br/>
                    <label for="rua" class="labelRegistrar"><img src="../presentation/image/numero.png"></label>
                    <input type="text" id="numero" name="numero" value=""  placeholder="0000" class="forRegistrar"/><br/>
                    <label for="rua" class="labelRegistrar">BAIRRO:</label>
                    <input type="text" id="bairro" name="bairro" value=""  placeholder="Bairro" class="forRegistrar"/><br/>
                    <label for="complemento" class="labelRegistrar">COMPLEMENTO:</label>
                    <input type="text" id="complemento" name="complemento" value="" placeholder="Apt,etc..." class="forRegistrar"/><br/>

                    <label for="cidade" class="labelRegistrar">ESTADO:</label>
                    <select id="estado" name="estado"  class="forRegistrarSelec" onchange="buscarCidades()">
                        <option value="" selected="">Selecione</option>
                        <?php
                        foreach ($estado as $es) {
                            echo"<option value='" . $es->getId() . "'>" . strtoupper($es->getNome()) . "</option>";
                            $es++;
                        }
                        ?>
                    </select><br/>
                    <div id="loadcidades">
                        <label for="cidade" class="labelRegistrar">CIDADE:</label>
                        <select id="cidade" name="cidade"  class="forRegistrarSelec">
                            <option selected value="">Escolha um estado</option>
                        </select>
                    </div>
                </fieldset>

                <fieldset class="fieldsetRegistrarLog">
                    <legend class="fildCssLegend"><b>DADOS DE LOGIN</b></legend><br/><br/>
                    <label for="email" class="labelRegistrar">E-MAIL:</label>
                    <input type="text" id="email" name="email" value="<?php echo $email; ?>"  placeholder="Email" class="forRegistrarLog" />

                    <br/>
                    <label for="senha" class="labelRegistrar">SENHA:</label>
                    <input type="password" id="primeiraSenha" name="primeiraSenha" placeholder="Senha" value="" class="forRegistrarLog"/>
                    <br/>
                    <label for="confirmarSenha" class="labelRegistrar">CONFIRMAR SENHA:</label>
                    <input type="password" id="senha" name="senha" value="" class="forRegistrarLog" onblur="valida();" placeholder="Digite novamente"/>
					 <input type="submit" value="Cadastrar" class="botaoCad">
                </fieldset>
            </form>  
			 
        </fieldset>
        <!-- Div para mostrar erros de validação! -->
        <div id="erro" class="erro"></div>
    </body>
</html>
