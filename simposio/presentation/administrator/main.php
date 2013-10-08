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
                    window.location.href='../index.php?pag=frmLogin.php'
              </script>";
        
    }
    //nivel para ter acesso a essa pagina
    $nivel_necessario = 2;
    // Verifica se não há a variavel da sessao que identifica o usuario
    if (!isset($_SESSION['email']) OR ($_SESSION['nivel'] < $nivel_necessario)){
        //destroi a sessao por segurança
        session_destroy();
        //redireciona o visitante de volta pro login
        header("Location: ../index.php?pag=frmLogin.php"); exit;
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css" media="all">@import url(../style/reset.css);@import url(../style/generic.css);@import url(../style/style.css);@import url(../style/alertas.css)</style>
        <script type="text/javascript" src="../js/jquery.js"></script>
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
                    window.location.href = "logout.php"; 
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
                    <li class="has-sub">"           "</li>
                    <li class='active'><a  href="main.php?" >Home</a></li>
                   
                    <li class='has-sub'><a  href="#" >Configurações</a>
                        <ul>
                            <li><a  href="#" >Eventos</a></li><br/>
                            <li><a  href="#" >Login</a></li>
                        </ul>
                    </li>
                    <li class='has-sub'><a  href="#">Atividades</a></li>
                    <!-- Logout do usuario -->
              
                    <li class='has-sub'><?php echo"<a href='javascript:func()' onclick='confirmacao2()'>Sair</a>";?></li>
                    
                </ul>
                <!-- fim menu principal -->
                
            
            </div>
            <!-- fim corpo -->
            <?php 
                if(isset($_GET['msg'])){
                    if($_GET['msg'] == 'alert'){
                         echo"<script language='javascript'>
                                alert('Sentimos muito mas houve choque de horario.');
                                window.location.href='../presentation/main.php?pag=frmMinicurso.php';
                             </script>";
                        
                    }
                    if($_GET['msg'] == 'sucess'){
                         echo"<script language='javascript'>
                                alert('Matricula realizada com sucesso.');
                                window.location.href='../presentation/main.php?pag=frmMinicurso.php';
                             </script>";
                        
                    }
                    if($_GET['msg'] == 'alert'){
                         echo"<script language='javascript'>
                                alert('Atenção! Você foi adicionado a lista de espera con sucesso!');
                                window.location.href='../presentation/main.php?pag=frmMinicurso.php';
                             </script>";
                        
                    }
                    if($_GET['msg'] == 'atention'){
                         echo"<script language='javascript'>
                                alert('Atenção! Você atingiu o numero maximo de inscrições permitidas.');
                                window.location.href='../presentation/main.php?pag=frmMinicurso.php';
                             </script>";
                        
                    }    
                    if($_GET['msg'] == 'ops'){
                         echo"<script language='javascript'>
                                alert('Atenção! Sentimos informa-lo que todas as vagas para esta atividade foram preenchidas.');
                                window.location.href='../presentation/main.php?pag=frmMinicurso.php';
                             </script>";
                        
                    }   
                }
                
                if(isset($_GET['atualiza'])){
                    if($_GET['atualiza'] == 1){
                         echo"<script language='javascript'>
                                alert('Dados atualizados com sucesso.');
                                window.location.href='../presentation/main.php?pag=frmEditPessoa.php';
                             </script>"; 
                    }
                    if($_GET['atualiza'] == 2){
                         echo"<script language='javascript'>
                                alert('Erro ao atualizar, tente novamente mais tarde.');
                                window.location.href='../presentation/main.php?pag=frmEditPessoa.php';
                             </script>"; 
                    }
                    if($_GET['atualiza'] == 0){
                         echo"<script language='javascript'>
                                alert('Atenção esse email já esta em uso! Tente um novo email.');
                                window.location.href='../presentation/main.php?pag=frmEditLogin.php';
                             </script>"; 
                    }
                    if($_GET['atualiza'] == 3){
                         echo"<script language='javascript'>
                                alert('Login atualizado com sucesso.');
                                window.location.href='../presentation/main.php?pag=frmEditLogin.php';
                             </script>"; 
                    }
                    
                }
                
            ?>
           
           
    </body>
</html>
