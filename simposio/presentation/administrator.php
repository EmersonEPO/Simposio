<?php
//A sessao precisa ser iniciada caso ela nao exista
//para ser feito a comparação log mais
if (!isset($_SESSION)) {
    session_start();
}

//nivel para ter acesso a essa pagina
$nivel_necessario = 2;
// Verifica se não há a variavel da sessao que identifica o usuario
if (!isset($_SESSION['email']) OR ($_SESSION['nivel'] < $nivel_necessario)) {
    //destroi a sessao por segurança
    session_destroy();
    //redireciona o visitante de volta pro login
    header("Location: index.php?pag=frmLogin.php");
    exit;
}
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

        <title>Administrator</title>
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
                    <li class="has-sub">"           "</li>
                    <li class='active'><a  href="administrator.php?" >Home</a></li>

                    <li class='has-sub'><a  href="#" >Perfil</a>
                        <ul>
                            <li><a  href="administrator.php?pag=admLogin.php" >Login</a></li>
                        </ul>
                    </li>
                    <li class='has-sub'><a  href="administrator.php?pag=admLista.php">Atividades</a></li>
                    <!-- Logout do usuario -->
                    <li class='has-sub'><?php echo"<a href='#' id='clickMe'>Sair</a>"; ?></li>

                </ul>
                <!-- fim menu principal -->


            </div>
            <!-- fim corpo -->
            <?php
            if (isset($_GET['atualiza'])) {
                if ($_GET['atualiza'] == 1) {
                    echo"<script language='javascript'>
                                alert('Dados atualizados com sucesso.');
                                window.location.href='administrator.php';
                             </script>";
                }
                if ($_GET['atualiza'] == 2) {
                    echo"<script language='javascript'>
                                alert('Erro ao atualizar, tente novamente mais tarde.');
                                window.location.href='administrator.php';
                             </script>";
                }
                if ($_GET['atualiza'] == 0) {
                    echo"<script language='javascript'>
                                alert('Atenção esse email já esta em uso! Tente um novo email.');
                                window.location.href='administrator.php?pag=admLogin.php';
                             </script>";
                }
                if ($_GET['atualiza'] == 3) {
                    echo"<script language='javascript'>
                                alert('Login atualizado com sucesso.');
                                window.location.href='administrator.php?pag=admLogin.php';
                             </script>";
                }
            }
            ?>


    </body>
</html>
