<?php
//A sessao precisa ser iniciada caso ela nao exista
//para ser feito a comparação log mais
if (!isset($_SESSION)) {
    session_start();
}

//nivel para ter acesso a essa pagina
$nivel_necessario = 1;
// Verifica se não há a variavel da sessao que identifica o usuario
if (!isset($_SESSION['email']) OR ($_SESSION['nivel'] < $nivel_necessario)) {
    //destroi a sessao por segurança
    session_destroy();
    //redireciona o visitante de volta pro login
    header("Location: ../presentation/index.php?pag=frmLogin.php");
    exit;
}
?>

<?php
//Listar todas as instituições, estados, cidade, colocando cada lista em seus respectivos select.
include_once "../dataAccess/InstituicaoDAO.php";
include_once "../domainModel/Instituicao.php";
include_once "../dataAccess/EstadoDAO.php";
include_once "../domainModel/Estado.php";
include_once "../domainModel/Pessoa.php";
include_once "../dataAccess/PessoaDAO.php";
include_once "../domainModel/Cidade.php";

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
<?php
header("Content-Type: text/html; charset=iso-8859-1", true);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <script src="js/jquery.js" type="text/javascript"></script>
            <script src="js/jquery.maskedinput.js" type="text/javascript"></script>
            <script rel="stylesheet" type="text/javascript" src="js/spryEffects.js"></script>
            <script type="text/javascript" src="validacao/validacao.js"></script>
            <script language="javascript" src="validacao/funcoes.js"></script>
            <script type="text/javascript">
                function MM_effectAppearFade(targetElement, duration, from, to, toggle){
                    Spry.Effect.DoFade(targetElement, {duration: duration, from: from, to: to, toggle: toggle});
                }
            </script>


            <style type="text/css" media="all">
                @import url(style/reset.css);
                @import url(style/base.css);
                @import url(style/font.css);
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


    </head>
    <body>
        <?php
        // put your code here
        ?>
        <fieldset class="fieldsetRegistrar2">
            <legend class="fildCssLegend"><b>EDITAR DADOS PESSOAIS</b></legend><br/>
            <form id="formPessoa" name="formPessoa" method="POST" action="../controller/CtlPessoaEditar.php?at" onsubmit="return validaPessoaEdit()">
                <label for="nome" class="labelRegistrar">NOME:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $p->getNome(); ?>"  class="forRegistrar"/><br/>
                <label for="cpf" class="labelRegistrar">CPF:</label>
                <input type="text" id="cpf" name="cpf" value="<?php echo $p->getCpf(); ?>" class="forRegistrar" maxlength="14" disabled=""/>

                <br/>
                <label for="nascimento" class="labelRegistrar">DATA DE NASCIMENTO:</label>
                <input type="text" id="nascimento" name="nascimento" value="<?php echo $p->getNascimento(); ?>" class="forRegistrar"/>

                <br/>
                <label for="sexo" class="labelRegistrar">SEXO:</label>
                <select id="sexo" name="sexo" class="forRegistrarSelec">
                    <option value="" selected="">Selecione</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select><br/>
                <script type='text/javascript'> $(document).ready(function(){  $('#sexo').val("<?php echo $p->getSexo(); ?>")}) </script>

                <label for="fone" class="labelRegistrar">TELEFONE:</label>
                <input type="text" id="fone" name="fone" value="<?php echo $p->getFone(); ?>" class="forRegistrar"/><br/>
                <label for="instituicao" class="labelRegistrar"><img src="../presentation/image/instituicao.png"></label>
                <select id="instituicao" name="instituicao" class="forRegistrarSelec" onchange="ativar();">
                    <option value="" selected="">Selecione</option>
                    <option value="1" >OUTRO</option>
                    <?php
                    foreach ($instituicao as $in) {
                        echo"<option value='" . $in->getId() . "'>" . strtoupper($in->getNome()) . "</option>";
                        $in++;
                    }
                    ?>
                </select><br/>
                <script type='text/javascript'> $(document).ready(function(){  $('#instituicao').val("<?php echo $p->getFk_instituicao(); ?>")}) </script>


                <label for="novaIns" class="labelRegistrar" id="novaIns1" style="display: none"><img src="../presentation/image/nome_ins.png"></label>
                <input type="text" id="novaIns" name="novaIns" value="" class="forRegistrar" placeholder="Nome da Inst." style="display: none"/><br/><br/>

                <fieldset class="fieldsetRegistrar3"><br/><br/>
                    <legend></legend>

                    <label for="rua" class="labelRegistrar"><img src="../presentation/image/endereco.png"></label>
                    <input type="text" id="rua" name="rua" value="<?php echo $p->getRua(); ?>" class="forRegistrar"/><br/>
                    <label for="rua" class="labelRegistrar"><img src="../presentation/image/numero.png"></label>
                    <input type="text" id="numero" name="numero" value="<?php echo $p->getNumero(); ?>" class="forRegistrar"/><br/>
                    <label for="rua" class="labelRegistrar">BAIRRO:</label>
                    <input type="text" id="bairro" name="bairro" value="<?php echo $p->getBairro(); ?>" class="forRegistrar"/><br/>
                    <label for="complemento" class="labelRegistrar">COMPLEMENTO:</label>
                    <input type="text" id="complemento" name="complemento" value="<?php echo $p->getComplemento(); ?>" class="forRegistrar"/><br/>

                    <?php
                    $c = new Cidade();
                    $c = $daoE->abrirIdEstado($p->getFk_cidade());
                    ?>
                    <label for="cidade" class="labelRegistrar">ESTADO:</label>
                    <select id="estado" name="estado" class="forRegistrarSelec" onchange="buscarCidades()">
                        <option value="" selected="">Selecione</option>
                        <?php
                        ini_set('default_charset', 'iso-8859-1');
                        foreach ($estado as $es) {
                            echo"<option value='" . $es->getId() . "'>" . strtoupper($es->getNome()) . "</option>";
                            $es++;
                        }
                        ?>
                    </select><br/>
                    <script type='text/javascript'> $(document).ready(function(){  $('#estado').val("<?php echo $c->getIdEstado(); ?>")}) </script>

                    <?php
                    include_once '../dataAccess/CidadeDAO.php';
                    include_once '../dataAccess/ConexaoDAO.php';
                    $cid = new CidadeDAO();
                    $tmp = new Cidade();
                    $tmp = $cid->Abrir($p->getFk_cidade());

                    // CARREGAR CIDADE POIS O METODO AJAX NAO SUPORTA O CARREGAMENTO AUTOMATICO NA EDICAO

                    $query = "SELECT * FROM cidade WHERE idEstado=" . $tmp->getIdEstado() . " ORDER BY nome";

                    $daoConexao = new conexaoDAO();
                    $conexaoAberta = $daoConexao->conectar();

                    //selecionar banco
                    $daoConexao->selecionarBanco();

                    //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
                    $resultado = $daoConexao->executeQuery($query);

                    //fecha conexao
                    $daoConexao->desconectar($conexaoAberta);


                    $lista = new ArrayObject();

                    while ($rs = mysql_fetch_array($resultado)) {
                        $novo = new Cidade();
                        $novo->setId(stripslashes($rs['idCidade']));
                        $novo->setNome(stripslashes($rs['nome']));
                        $novo->setIdEstado(stripslashes($rs['idEstado']));
                        $lista->append($novo);
                    }
                    ?>          

                    <div id="loadcidades">
                        <label for="cidade" class="labelRegistrar">CIDADE:</label>
                        <select id="cidade" name="cidade"  class="forRegistrarSelec">
                            <!--<option selected value="">Escolha um estado</option>-->
                            <?php
                            ini_set('default_charset', 'iso-8859-1');
                            foreach ($lista as $ci) {
                                echo"<option value='" . $ci->getId() . "'>" . $ci->getNome() . "</option>";
                                $es++;
                            }
                            ?>
                        </select>
                        <script type='text/javascript'> $(document).ready(function(){  $('#loadcidades').val("<?php echo $p->getFk_cidade(); ?>")}) </script>
                    </div>

                    <script type='text/javascript'> $(document).ready(function(){  $('#cidade').val(<?php echo $p->getFk_cidade(); ?>)}) </script>

                    <input type="submit" value="Atualizar" class="botaoAtualizarPessao">
                </fieldset>
            </form>


        </fieldset>
        <!-- Div para mostrar erros de validação! -->
        <div id="erro" class="erroEditPessoa"></div>
    </body>
</html>
