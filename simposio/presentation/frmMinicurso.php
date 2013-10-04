<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php
    include_once "../dataAccess/AtividadeDAO.php";
    include_once "../domainModel/Atividade.php";
    
    $daoA = new AtividadeDAO();
    $atividade = new Atividade();
    $atividade = $daoA->listaTodos();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css" media="all">@import url(style/reset.css);@import url(style/generic.css);@import url(style/style.css);</style>
        <title></title>
    </head>
    <body>
            <?php
                echo "<table name='tbl' id='tbl' border='1' class='cssTblAtividade'>";
                echo "<tr>";
                echo "<td width='600' align='middle' class='cssRow1'><b>NOME</b></td>";
                echo "<td width='600' align='middle' class='cssRow1'><b>MINISTRANTE</b></td>";
                echo "<td width='600' align='middle' class='cssRow1'><b>DURAÇAO</b></td>";
                echo "<td width='600' align='middle' class='cssRow1'><b>LOCAL</b></td>";
                
                
                
                

                echo "</tr>";

                foreach ($atividade as $at) {
                    echo "<tr>";
                    echo "<td width='1200' align='middle' class='cssRow'>" . $at->getNome() . "</td>";
                    echo "<td width='1200' align='middle' class='cssRow'>" . $at->getFk_ministrante() . "</td>";
                    echo "<td width='1200' align='middle' class='cssRow'>" . $at->getDuracao() . "</td>";
                    echo "<td width='1200' align='middle' class='cssRow'>" . $at->getLocal() . "</td>";
                    echo "<td><a href='#'" . $at->getId() . " class='tblBotao'><img src='image/confirm2.png'></a></td>";
                 
                    echo "</tr>";
                    $at++;
                }
                echo "</table>";

            ?>
    </body>
</html>
