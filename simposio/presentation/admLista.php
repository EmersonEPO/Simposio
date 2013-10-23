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
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
         <style type="text/css" media="all">
            @import url(style/reset.css);
            @import url(style/base.css);
            @import url(style/font.css);
            @import url(style/style.css);
            @import url(style/alert.css);
        </style>
        <title></title>
    </head>
    <body>
        <?php
        include_once "../dataAccess/AtividadeDAO.php";
        include_once "../domainModel/Atividade.php";

        $daoA = new AtividadeDAO();
        $atv = new Atividade();

        $atv = $daoA->listaTodos();

        echo "<div  class='cssLinkPdf'>";
        foreach ($atv as $a) {
            echo "<a href='../controller/CtlListasPDF.php?id=" . $a->getId() . "'  target='_blank'><img src='../presentation/image/pdf.gif'>" . $a->getNome() . "</a><br/><br/>";
            $a++;
        }
        echo "</div>";
        ?>
    </body>
</html>
