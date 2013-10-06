<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php
    //resolver problemas relacionado aos acentos
    header("Content-Type: text/html; charset=ISO-8859-1", true);
    
    include_once "../dataAccess/AtividadeDAO.php";
    include_once "../domainModel/Atividade.php";
    include_once "../dataAccess/MinistranteDAO.php";
    include_once "../domainModel/Ministrante.php";
    include_once "../dataAccess/TipoAtividadeDAO.php";
    include_once "../domainModel/TipoAtividade.php";
    
    $daoA = new AtividadeDAO();
    $atividade = new Atividade();
    $atividade = $daoA->listaTodos();
    
    //ministrante
    $daoM = new MinistranteDAO();
    $ministrante = new Ministrante();
    
    //TipoAtividade
    $daoTA = new TipoAtividadeDAO();
    $tipoAtividade = new TipoAtividade();
    
   
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-Type" content="text/html; charset=iso-utf-8" />
        <style type="text/css" media="all">@import url(style/reset.css);@import url(style/generic.css);@import url(style/style.css);</style>
        <title></title>
    </head>
    <body>
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
                    echo "<td><a href='../controller/CtlParticipar.php?id=" . $at->getId() . "' class='tblBotao'><img src='image/confirm.png'></a></td>";
                 
                    echo "</tr>";
                    $at++;
                }
                echo "</table>";
            ?>
        
            <!-- Alertas -->
            <?php
            
                    if (isset($_GET['msg'])) {
                    $alerta = $_GET['msg'];
                    //destruindo $_GET['msg']
                    unset($_GET['msg']);

                    //-----
                    if (isset($_GET['max'])) {
                        $max = $_GET['max'];
                    }

                    if ($alerta == 1)
                        echo "<script type='text/javascript'>alert('Matricula Realizada com sucesso');</script>";
                    if ($alerta == 2)
                        echo "<script type='text/javascript'>alert('Matricula realizada com sucesso na lista de Espera');</script>";
                    if ($alerta == 3)
                        echo "<script type='text/javascript'>alert('Sentimos informa-lo que todas foram preenchidas!');</script>";
                    if ($alerta == 4)
                        echo "<script type='text/javascript'>alert('Voce ja efetuou o numero maximo de " . $max . " matriculas!');</script>";
                } else {
                    //destruindo $_GET['msg']
                    unset($_GET['msg']);
                }

                //limite de matriculas que podem ser efeutadas por usuario
                //destruindo alerta
                unset($alerta);
            ?>
            <!-- fim alertas -->
    </body>
</html>
