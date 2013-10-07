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

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css" media="all">@import url(style/reset.css);@import url(style/generic.css);@import url(style/style.css);@import url(style/alertas.css)</style>
        <script type="text/javascript" src="js/jquery.js"></script>
        <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
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
        <!-- fim script -->
        <script language="Javascript">
	
            function confirmacao2() { 
                var resposta = confirm("Realmente deseja sair?");   
                if (resposta == true) { 
                    window.location.href = "../presentation/logout.php"; 
                } 
            } 
        </script>
    
        <title>Simpósio</title>
    </head>
    <body>
        <!-- Conteudo -->
        <div>
            
            <!-- corpo -->
            <div id="cssmenu">
                <?php
                //Com isso todas as paginas que forem chamadas serão aberta em main
                if(isset($_GET["pag"])){
                    include $_GET["pag"];
                }
                //------
                ?>
                
                <!-- Menu principal -->
                
                <ul>
                    <li class='active'><a  href="../presentation/main.php?" >Home</a></li>
                    
                    <li class='has-sub'><a  href="#" >Informações</a>
                        <ul>
                            <li><a  href="#" >Dados Pessoais</a></li><br/>
                            <li><a  href="#" >Login</a></li>
                        </ul>
                    </li>
                    <li class='has-sub'><a  href="../presentation/main.php?pag=frmMinicurso.php">Minicursos</a></li>
                    <!-- Logout do usuario -->
                    <li class='has-sub'><?php echo"<a href='javascript:func()' onclick='confirmacao2()'>Sair</a>";?></li>
                    
                </ul>
                <!-- fim menu principal -->
                
            
            </div>
            <!-- fim corpo -->
           
            
            
        
    </body>
</html>
