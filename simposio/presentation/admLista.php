<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
            foreach ($atv as $a){
                echo "<a href='../controller/CtlListasPDF.php'  target='_blank'><img src='../presentation/image/pdf.gif'>  ".$a->getNome()."</a><br/><br/>";
                $a++;
            }
            echo "</div>";
        ?>
    </body>
</html>
