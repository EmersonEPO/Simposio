<?php
    include_once "../dataAccess/connection.php";
    
    $email = mysql_real_escape_string( $_POST['email']);
    $senha = mysql_real_escape_string( $_POST['senha']);
   

    $sql = "SELECT * FROM usuario WHERE '".$email."' = email AND '".$senha."' = senha LIMIT 1";
    $query = mysql_query($sql);
    
    if (mysql_num_rows($query) != 1){
        //senha e usuario invalido
        //echo $sql;
        //redireciona para a tela de login
        header("Location: index.php"); exit;
   
    }else{
	// Salva os dados encontados na variável $resultado
	$resultado = mysql_fetch_assoc($query);
        // Se a sessão não existir, inicia uma
        //echo $sql;
        //tempo em segundos para a a sessao ser encerrada     
        if (!isset($_SESSION)){
            //inicia uma nova sessao
            session_start();
            //criar um cokie para indicar se a sessao deve ser finalizada
            setcookie("expira",0,(time() + 10));
            //-----
         }
	    // Salva os dados encontrados na consulta sql dentro de uma sessão
	    $_SESSION['email'] = $resultado['email'];
	    $_SESSION['nivel'] = $resultado['nivel'];
            $_SESSION['nome'] = $resultado['nome'];
	    // Redireciona 
            header("Location: main.php"); exit;	
	}
		


?>

