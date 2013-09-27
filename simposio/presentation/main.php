<?php
    // A sessao precisa ser iniciada
    if (!isset($_SESSION)) {
        session_start();
    }
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
        <link rel="stylesheet" type="text/css" href="style/resetar.css" >
        <link rel="stylesheet" type="text/css" href="style/style.css" >
    
        <title>Simpósio</title>
    </head>
    <body>
        <!-- Conteudo -->
        <div>
            <?php
                //Com isso todas as paginas que forem chamadas serão aberta em main
                if(isset($_GET["pagina"])){
                    include $_GET["pagina"];
                }
                //------
            ?>
            <!-- menu horizontal -->
            <div class="div-menuprincipal">
                <?php
                            include_once "menuHorizontal.php";
                ?>
                
            </div>
            <!-- fim menu -->
            
            <!-- corpo -->
            <div class="div-corpo">
                
                
            </div>
            <!-- fim corpo -->
            
            
        
    </body>
</html>
