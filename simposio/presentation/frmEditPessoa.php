<?php
    //A sessao precisa ser iniciada caso ela nao exista
    //para ser feito a comparação log mais
    if (!isset($_SESSION)) {
        session_start();
    }

    //Se o cokie criado apos o login não existir mais
    //significa que a sessao deve ser finalizada
    if(!isset($_COOKIE['expira'])){
        //detroi sessao
        session_destroy();
        //por segurança, estou destruindo também o cokie
        setcookie("expira");
        //mensagem informando que o tempo do usuario expirou, redireciona para index
        echo "<script language='javascript'>
                    window.location.href='../presentation/index.php?pag=frmLogin.php'
              </script>";
        
    }
    //nivel para ter acesso a essa pagina
    $nivel_necessario = 1;
    // Verifica se não há a variavel da sessao que identifica o usuario
    if (!isset($_SESSION['email']) OR ($_SESSION['nivel'] < $nivel_necessario)){
        //destroi a sessao por segurança
        session_destroy();
        //redireciona o visitante de volta pro login
        header("Location: ../presentation/index.php?pag=frmLogin.php"); exit;
    }
    
?>

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
    include_once "../domainModel/Pessoa.php";
    include_once "../dataAccess/PessoaDAO.php";
   
    //pessoa
    $daoP = new PessoaDAO();
    $p = new Pessoa();
    
    $idPessoa = $_SESSION['id'];
    $p = $daoP->abrir($idPessoa);
    
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
        <style type="text/css" media="all">
            @include url('http://yui.yahooapis.com/3.5.0/build/cssreset/cssreset-min.css');
            @include url('http://yui.yahooapis.com/3.5.0/build/cssbase/cssbase-min.css');
            @include url('http://yui.yahooapis.com/3.5.0/build/cssfonts/cssfonts-min.css');
            @import url(style/style.css);
        </style>
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
        <script type="text/javascript">
          
        </script>
            
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <fieldset class="fieldsetRegistrar2">
            <legend>DADOS PESSOAIS </legend>
            <form id="formPessoa" name="formPessoa" method="POST" action="../controller/CtlPessoaEditar.php">
                <label for="nome" class="labelRegistrar">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $p->getNome(); ?>" required=""  class="forRegistrar"/><br/>
                <label for="cpf" class="labelRegistrar">Cpf:</label>
                <input type="text" id="cpf" name="cpf" value="<?php echo $p->getCpf(); ?>" required="" class="forRegistrar" maxlength="11"/>
 
                <br/>
                <label for="nascimento" class="labelRegistrar">Nascimento:</label>
                <input type="text" id="nascimento" name="nascimento" value="<?php echo $p->getNascimento(); ?>" required="" class="forRegistrar"/>
            
                <br/>
                <label for="sexo" class="labelRegistrar">Sexo:</label>
                <select id="sexo" name="sexo" required="" class="forRegistrarSelec">
                    <option value="" selected="">Selecione</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select><br/>
                <label for="fone" class="labelRegistrar">Telefone:</label>
                <input type="text" id="fone" name="fone" value="<?php echo $p->getFone(); ?>" required="" class="forRegistrar"/><br/>
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
                
                <label for="novaIns" class="labelRegistrar" id="novaIns1" style="display: none">Instituição:</label>
                <input type="text" id="novaIns" name="novaIns" value="" class="forRegistrar" style="display: none"/><br/><br/>
         
                <fieldset class="fieldsetRegistrar3">
                    <legend>ENDEREÇO</legend>
                        
                    <label for="rua" class="labelRegistrar">Endereço:</label>
                    <input type="text" id="rua" name="rua" value="<?php echo $p->getRua(); ?>" required="" class="forRegistrar"/><br/>
                    <label for="rua" class="labelRegistrar">Numero:</label>
                    <input type="text" id="numero" name="numero" value="<?php echo $p->getNumero(); ?>" required="" class="forRegistrar"/><br/>
                    <label for="rua" class="labelRegistrar">Bairro:</label>
                    <input type="text" id="bairro" name="bairro" value="<?php echo $p->getBairro(); ?>" required="" class="forRegistrar"/><br/>
                    <label for="complemento" class="labelRegistrar">Complemento:</label>
                    <input type="text" id="complemento" name="complemento" value="<?php echo $p->getComplemento(); ?>" class="forRegistrar"/><br/>

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
                    <input type="submit" value="Atualizar" class="botaoAtualizar">
                </fieldset>
            </form>
            
            
        </fieldset>
    </body>
</html>
