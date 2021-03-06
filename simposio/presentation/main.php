﻿<?php
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
	header("Content-Type: text/html; charset=iso-8859-1",true); 
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <style type="text/css" media="all">
            @import url(style/reset.css);
            @import url(style/base.css);
            @import url(style/font.css);
            @import url(style/style.css);
            @import url(style/alert.css);
        </style>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
        <script type="text/javascript" src="js/alertBox.js"></script>
        <script src="scripts/jquery.alert.js" type="text/javascript"></script>
        <link href="css/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />
        <!-- script auxiliar do jquery para o menu dropdown -->
        <script type="text/javascript">
            $(document).ready(function(){      
                $('.nav li').hover(
                
                function(){
                    $('ul', this).fadeIn();
                },
		
                function(){
                    $('ul', this).fadeOut();
                }          
            );       
            }); 
        </script>
        <!-- fim script  PARA MENSAGEM DE SAIR--> 
        <script>
            $(function() {
                $('#clickMe').alertBox({
                    href: '../presentation/logout.php'
                });
            });
        </script>

        <title>Bem-vindo</title>
    </head>
    <body>
        <!-- Conteudo -->
        <div>

            <!-- corpo -->
            <div id="cssmenu">
                <?php
                //Com isso todas as paginas que forem chamadas serão aberta em main
                if (isset($_GET["pag"])) {
                    include $_GET["pag"];
                }
                //------
                ?>
		
                <!-- Menu principal -->

                <ul>
                    <li class="has-sub"></li>
                    <li class='active'><a href="#" style="pointer-events: none;"></a></li>

                    <li class='has-sub'><a  href="#" >Perfil</a>
                        <ul>
                            <li><a  href="../presentation/main.php?pag=frmEditPessoa.php" >Alterar Dados</a></li><br/>
                            <li><a  href="../presentation/main.php?pag=frmEditLogin.php" >Alterar Senha</a></li>
                        </ul>
                    </li>
                    <li class='has-sub'><a  href="../presentation/main.php?pag=frmMinicurso.php&Qua">Mini-Cursos</a></li>
                    <li class='has-sub'><a  href="http://200.131.5.227/simposio" target="_blank" ><img src="image/simposio.png"/></a></li>
                    <!-- Logout do usuario -->
                    <li class='has-sub'><?php echo"<a href='#' id='clickMe'>Sair</a>"; ?></li>

                </ul>
                <!-- fim menu principal -->



            </div>
            <!-- fim corpo -->


            <?php
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'atention') {
                    echo"<div id='mensagem' style='' class='error'>";
                    echo"<p>Operação cancelada! Você atingiu o número máximo de inscrições permitidas.</p>";
                    echo"</div>";
                }
                if ($_GET['msg'] == 'sucess') {
                    echo"<div id='mensagem' style='' class='success'>";
                    echo"<p>Pré-inscrição realizada com sucesso!</p>";
                    echo"</div>";
                }
                if ($_GET['msg'] == 'alert') {
                    echo"<div id='mensagem' style='' class='error'>";
                    echo"<p>Escolha outro mini-curso, houve choque de horário!</p>";
                    echo"</div>";
                }

                if ($_GET['msg'] == 'important') {
                    echo"<div id='mensagem' style='' class='warning'>";
                    echo"<p>Atenção, pré-inscrição realizada com sucesso na lista de espera.</p>";
                    echo"</div>";
                }
                if ($_GET['msg'] == 'ops') {
                    echo"<div id='mensagem' style='' class='info'>";
                    echo"<p>Sentimos informá-lo que todas as vagas para este mini-curso foram preenchidas.</p>";
                    echo"</div>";
                }
            }

            if (isset($_GET['atualiza'])) {
                if ($_GET['atualiza'] == 1) {
                    echo"<div id='mensagem' style='' class='success'>";
                    echo"<p>Dados atualizados com sucesso!</p>";
                    echo"</div>";
                }
                if ($_GET['atualiza'] == 2) {
                    echo"<div id='mensagem' style='' class='error'>";
                    echo"<p>Ocorreu um erro, tente novamente mais tarde.</p>";
                    echo"</div>";
                }
                if ($_GET['atualiza'] == 0) {
                    echo"<div id='mensagem' style='' class='success'>";
                    echo"<p>Senha atualizada com sucesso!</p>";
                    echo"</div>";
                    
                }
            }
            ?>


    </body>
</html>
