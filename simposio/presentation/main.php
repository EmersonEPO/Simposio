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
                    alert('Seu tempo expirou manolo!');
                    window.location.href='../presentation/index.php'
              </script>";
        
    }
    //nivel para ter acesso a essa pagina
    $nivel_necessario = 1;
    // Verifica se não há a variavel da sessao que identifica o usuario
    if (!isset($_SESSION['email']) OR ($_SESSION['nivel'] < $nivel_necessario)){
        // Destroi a sessao por seguran?a
	session_destroy();
	// Redireciona o visitante de volta pro login
	header("Location: ../presentation/index.php"); exit;
        //modificar depois dos testes
    }
    
?>
<?php
    include_once "../dataAccess/connection.php";   

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css" media="all">@import url(style/reset.css);@import url(style/generic.css);@import url(style/style.css);</style>
        <script type="text/javascript" src="js/jquery.js"></script>
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
    
        <title>Simpósio</title>
    </head>
    <body>
        <!-- Conteudo -->
        <div>
            
            <!-- corpo -->
            <div class="div-corpo">
                <?php
                //Com isso todas as paginas que forem chamadas serão aberta em main
                if(isset($_GET["pagina"])){
                    include $_GET["pagina"];
                }
                //------
                ?>
                <!-- Menu principal -->
                
                <ul class="nav">
                    <li><a  href="main.php?pagina=save/frmPessoa.php">Dados Gerais</a></li>
                    <li><a  href="#">menu 2</a></li>
                   
                    <li><a  href="#" >menu 3</a>
                        <ul>
                            <li><a  href="#" >menu 3.1</a></li>
                            <li><a  href="#" >menu 3.2</a></li>
                            <li><a  href="#" >menu 3.3</a></li>
                        </ul>
                    </li>
                   
                    <li><a  href="#">menu 4</a></li>
                    <li><a  href="#">menu 5</a></li>  
                   
                    <li><a  href="#">menu 6</a></li> 
                    <!-- Logout do usuario -->
                    <li><a  href="#" class="cssuser"><?php echo "[".$_SESSION['nome']."]"; ?></a>
                        <ul>
                            <li><a  href="#" >Configurações</a></li>
                            <li><a href="logout.php" >Logout</a></li>
                        </ul>
                    </li>
                    
                </ul>
                <!-- fim menu principal -->
                
            
            </div>
            <!-- fim corpo -->
            
            
        
    </body>
</html>
