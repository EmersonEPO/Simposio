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

<?php
    //resolver problemas relacionado aos acentos
    header("Content-Type: text/html; charset=ISO-UTF-8", true);
    
    include_once "../dataAccess/AtividadeDAO.php";
    include_once "../domainModel/Atividade.php";
    include_once "../dataAccess/MinistranteDAO.php";
    include_once "../domainModel/Ministrante.php";
    include_once "../dataAccess/TipoAtividadeDAO.php";
    include_once "../domainModel/TipoAtividade.php";
    include_once "../dataAccess/MatriculaDAO.php";
    
    $daoA = new AtividadeDAO();
    $atividade = new Atividade();
    $atividade = $daoA->listaTodos();
    
    //ministrante
    $daoM = new MinistranteDAO();
    $ministrante = new Ministrante();
    
    //TipoAtividade
    $daoTA = new TipoAtividadeDAO();
    $tipoAtividade = new TipoAtividade();
    
    //matricula
    $daoMa = new MatriculaDAO();
    
   
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css" media="all">@import url(style/reset.css);@import url(style/generic.css);@import url(style/style.css);@import url(style/alertas.css);</style>
        <title></title>
         <script language="Javascript">
	
            function confirmacao(id) { 
                var resposta = confirm("Realmente deseja prosseguir com essa operação? Lembre-se ela não poderá ser desfeita posteriormente.");   
                if (resposta == true) { 
                    window.location.href = "../controller/CtlParticipar.php?id="+id; 
                } 
            } 
        </script>
    </head>
    <body>
            <!-- Alertas -->
            <!-- fim alertas -->
            <?php
                echo "<table name='tbl' id='tbl' border='1' class='cssTblAtividade'>";
                echo "<tr>";
                echo "<td width='600' align='middle' class='cssRow1'><b>NOME</b></td>";
                echo "<td width='600' align='middle' class='cssRow1'><b>TIPO</b></td>";
                echo "<td width='600' align='middle' class='cssRow1'><b>DURAÇÃO</b></td>";
                echo "<td width='600' align='middle' class='cssRow1'><b>DATA</b></td>";
                echo "<td width='600' align='middle' class='cssRow1'><b>INICIO</b></td>";
                echo "<td width='600' align='middle' class='cssRow1'><b>TERMINO</b></td>";
                echo "<td width='600' align='middle' class='cssRow1'><b>LOCAL</b></td>";
                echo "<td width='600' align='middle' class='cssRow1'><b>MINISTRANTE</b></td>";
                echo "<td width='600' align='middle' class='cssRow1'><b>FORMAÇÃO</b></td>";
                echo "</tr>";

                foreach ($atividade as $at) {
                    echo "<tr>";
                    echo "<td width='1200' align='middle' class='cssRow'>" . $at->getNome() . "</td>";
                    //bucar nome do tipo de atividade
                    $tipoAtividade = $daoTA->abrir($at->getFk_tipoAtv());
                    echo "<td width='1200' align='middle' class='cssRow'>" . $tipoAtividade->getNome() . "</td>";
                    
                    //tipo de duracao 1 = horas ou 2 == minutos
                    if($at->getTipoDuracao() == 1){
                        echo "<td width='1200' align='middle' class='cssRow'>" . $at->getDuracao() ." Hora(s)". "</td>";
                    }else{
                        echo "<td width='1200' align='middle' class='cssRow'>" . $at->getDuracao() ." Min". "</td>";
                    }
                    //-----
                    echo "<td width='1200' align='middle' class='cssRow'>" . $at->getDataAtividade() . "</td>";
                    echo "<td width='1200' align='middle' class='cssRow'>" . $at->getHoraInicio() . "</td>";
                    echo "<td width='1200' align='middle' class='cssRow'>" . $at->getHoraTermino() . "</td>";
                    echo "<td width='1200' align='middle' class='cssRow'>" . $at->getLocal() . "</td>";
                    //bucar nome do ministrante
                    $ministrante = $daoM->abrir($at->getFk_ministrante());
                    echo "<td width='1200' align='middle' class='cssRow'>" . $ministrante->getNome() . "</td>";
                    echo "<td width='1200' align='middle' class='cssRow'>" . $ministrante->getFormacao() . "</td>";
                    echo "<td><a href='javascript:func()' onclick='confirmacao(".$at->getId().")' class='tblBotao'><img src='image/confirm.png'></a></td>";
                 
                    echo "</tr>";
                    $at++;
                }
                echo "</table>";
               
            ?>
            <?php
                //verifica se o usuario ja possui alguma matricula para que entao seja exibida a opção de gerar pdf
                if($daoMa->existteMatricula($_SESSION['id']) == true){
                    echo"<div class='csspdf'>";
                    echo "<a href='../controller/CtlMatriculaPDF.php'><img src='../presentation/image/pdf.gif'> Imprimir Matricula</a>";
                    echo "</div>";
                 }
            ?>
            
            
            
        
    </body>
</html>
