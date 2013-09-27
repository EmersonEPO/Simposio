<?php
 
    // A sessao precisa ser iniciada
    if (!isset($_SESSION)) {
        session_start();
    }
    $nivel_necessario = 1;
    // Verifica se não há a variavel da sessao que identifica o usuario
    if (!isset($_SESSION['nome']) OR ($_SESSION['nivel'] < $nivel_necessario)){
        // Destroi a sessao por seguran?a
	session_destroy();
	// Redireciona o visitante de volta pro login
	header("Location: ../presentation/index.php");
        exit;
   }
	 
?>


<?php 
    session_start();
    // Destroi a sessao
    session_destroy(); 
    // Redireciona para o login
    header("Location: index.php"); 
    exit; 
?>
