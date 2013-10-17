<?php
//A sessao precisa ser iniciada caso ela nao exista
//para ser feito a comparação log mais
if (!isset($_SESSION)) {
    session_start();
}

//nivel para ter acesso a essa pagina
$nivel_necessario = 1;
// Verifica se não há a variavel da sessao que identifica o usuario
if (!isset($_SESSION['email']) OR ($_SESSION['nivel'] < $nivel_necessario)) {
    //destroi a sessao por segurança
    session_destroy();
    //redireciona o visitante de volta pro login
    header("Location: ../presentation/index.php?pag=frmLogin.php");
    exit;
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <style type="text/css" media="all">
            @import url(style/reset.css);
            @import url(style/base.css);
            @import url(style/font.css);
            @import url(style/style.css);

            #cssmenu > ul > li {
                float: left;
                margin-left: 55px;
                margin-top: -15px;
                position: relative;
            }
        </style>

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


        <!-- Atividades por data ->
        <?php
        //muda a cor do botoes, aparentando que estao precionados
        //Para que isso funcione é preciso enviar as variaveis Qui, Qua e Sex fia GET para essa pag
        if (isset($_GET['Qua'])) {
            echo"<style type='text/css'> .cssAbaLink1{background: #e0e0e0;}</style>";
            $data = "2013-11-06"; //data refente ao dia da semana
        }
        if (isset($_GET['Qui'])) {
            echo"<style type='text/css'> .cssAbaLink2{background: #e0e0e0;}</style>";
            $data = "2013-11-07"; //data refente ao dia da semana
        }
        if (isset($_GET['Sex'])) {
            echo"<style type='text/css'> .cssAbaLink3{background: #e0e0e0;}</style>";
            $data = "2013-11-08"; //data refente ao dia da semana
        }
        ?>
            
        <?php
        include_once "../dataAccess/AtividadeDAO.php";
        include_once "../domainModel/Atividade.php";
        include_once "../dataAccess/MinistranteDAO.php";
        include_once "../domainModel/Ministrante.php";
        include_once "../dataAccess/TipoAtividadeDAO.php";
        include_once "../domainModel/TipoAtividade.php";
        include_once "../dataAccess/MatriculaDAO.php";
        include_once "../domainModel/Controle.php";
        include_once "../dataAccess/ControleDAO.php";

        $daoA = new AtividadeDAO();
        $atividade = new Atividade();
        $atividade = $daoA->listaTodosPorData($data);

        //ministrante
        $daoM = new MinistranteDAO();
        $ministrante = new Ministrante();

        //TipoAtividade
        $daoTA = new TipoAtividadeDAO();
        $tipoAtividade = new TipoAtividade();

        //matricula
        $daoMa = new MatriculaDAO();

        //controle
        $daoC = new ControleDAO();
        $controle = new Controle();

        //aqui inicio o teste para ver quais "atividades" o usuario já esta 
        //registrado para entao deixar um botao agradavel para ele... ¬¬
        $atv = new Atividade();
        ?>
        
        

        <!-- -->
        <div class="divLegenda">
            <img src="image/no.png"> Inscrever-se em alguma atividade<br/>
            <img src="image/es.png"> Inscrever-se na lista de espera<br/>
            <img src="image/er.png"> Todas as vagas foram preenchidas<br/>
            <img src="image/su.png"> Inscrito na atividadade<br/>
            <img src="image/pr.png"> Pre-inscrito na atividadade<br/>


        </div>

        <?php
        echo "<table name='tbl' id='tbl' style='boder:none;' class='cssTblAtividade'>";
        echo "<tr>";
        //esquema para "paginação"
        echo"<td colspan='9' border='0'>";
        echo"<div class='cssAba'>";
        if (isset($_GET['Qua'])) {
            echo"<style type='text/css'> .cssAbaLink1{background: #e0e0e0;}</style>";
        }
        if (isset($_GET['Qui'])) {
            echo"<style type='text/css'> .cssAbaLink2{background: #e0e0e0;}</style>";
        }
        if (isset($_GET['Sex'])) {
            echo"<style type='text/css'> .cssAbaLink3{background: #e0e0e0;}</style>";
        }
        echo "<a href='main.php?pag=frmMinicurso.php&Qua'><input type='submit' value='Quarta-feira' class='cssAbaLink1'></a>";
        echo "<a href='main.php?pag=frmMinicurso.php&Qui'><input type='submit' value='Quinta-feira' class='cssAbaLink2'></a>";
        echo "<a href='main.php?pag=frmMinicurso.php&Sex'><input type='submit' value='Sexta-feira' class='cssAbaLink3'></a>";
        echo"</div>";
        echo"</td><br/>";
        echo"</tr>";
        //fim
        //continuação normal da tabela
        echo"<tr>";
        echo "<td width='600' align='middle' class='cssRow1'><b>NOME</b></td>";
        echo "<td width='600' align='middle' class='cssRow1'><b>TIPO</b></td>";
        echo "<td width='600' align='middle' class='cssRow1'><b>C.H.</b></td>";
        echo "<td width='600' align='middle' class='cssRow1'><b>DATA</b></td>";
        echo "<td width='600' align='middle' class='cssRow1'><b>INICIO</b></td>";
        echo "<td width='600' align='middle' class='cssRow1'><b>TERMINO</b></td>";
        echo "<td width='600' align='middle' class='cssRow1'><b>LOCAL</b></td>";
        echo "<td width='600' align='middle' class='cssRow1'><b>MINISTRANTE</b></td>";
        echo "<td width='600' align='middle' class='cssRow1'><b>TITULO</b></td>";
        echo "</tr>";

        foreach ($atividade as $at) {
            echo "<tr class='linha-td'>";
            echo "<td class='linha-td' width='1200' align='middle' class='cssRow'>" . $at->getNome() . "</td>";
            //bucar nome do tipo de atividade
            $tipoAtividade = $daoTA->abrir($at->getFk_tipoAtv());
            echo "<td class='linha-td' width='1200' align='middle' class='cssRow'>" . $tipoAtividade->getNome() . "</td>";

            //tipo de duracao 1 = horas ou 2 == minutos
            if ($at->getTipoDuracao() == 1) {
                echo "<td class='linha-td' width='1200' align='middle' class='cssRow'>" . $at->getDuracao() . " Hora(s)" . "</td>";
            } else {
                echo "<td class='linha-td' width='1200' align='middle' class='cssRow'>" . $at->getDuracao() . " Min" . "</td>";
            }


            //verifiar se existe vaga na lista de normal,espera ou se ja esgotou

            $inscrever = "nada";

            //verifiar se existe vaga na lista de normal,espera ou se ja esgotou
            $controle = $daoC->abrirtotal($at->getId());
            $atv = $daoA->listarAtividadeDoUser($_SESSION['id']);

            $total_vagas_espera = 5;
            //se lista de vagas normais ainda contiver vagas
            if (($controle->getTotalVaga() > 0) and ($controle->getTotalEspera() == $total_vagas_espera)) {

                //verificar se o usuario já se inscreveu em alguma disciplina
                $atv2 = 0;
                if ($daoA->listarAtividadeDoUser($_SESSION['id']) != null) {
                    foreach ($atv as $atv2) {

                        if ($at->getId() == $atv2->getId()) {
                            $inscrever = "Inscrito";
                            break;
                        } else {
                            $inscrever = "Inscreva-se";
                        }

                        $atv2++;
                    }
                } else {

                    $inscrever = "Inscreva-se";
                }
                //se lista de vagas normais NAO contiver vagas
            } else {
                //verificar novamente se o usuario já se inscreveu em alguma disciplina
                $atv2 = 0;
                if ($daoA->listarAtividadeDoUser($_SESSION['id']) != null) {
                    foreach ($atv as $atv3) {
                        if ($at->getId() == $atv3->getId()) {
                            if ($controle->getTotalEspera() == $total_vagas_espera) {
                                $inscrever = "Inscrito";
                            } else {
                                $inscrever = "Pre-inscrito";
                            }
                            break;
                        } else {
                            //se lista de espera ainda contiver vagas
                            if (($controle->getTotalEspera() > 0) and ($controle->getTotalEspera() <= $total_vagas_espera)) {
                                $inscrever = "Espera";
                            } else {
                                $inscrever = "Esgotado";
                            }
                        }
                        $atv2++;
                    }
                } else {
                    //se lista de espera ainda contiver vagas
                    if (($controle->getTotalEspera() > 0) and ($controle->getTotalEspera() <= 5)) {
                        $inscrever = "Espera";
                    } else {
                        $inscrever = "Esgotado";
                    }
                }
            }


            //if para mudar cor do botao
            if ($inscrever == "Inscrito") {
                $estilo = "botaoInscrito";
                $link = "";
            } else {
                if ($inscrever == "Pre-inscrito") {
                    $estilo = "botaoPreInscrito";
                    $link = "";
                } else
                if ($inscrever == "Espera") {
                    $estilo = "botaoEspera";
                    $link = "javascript:func()' onclick='confirmacao(" . $at->getId() . ")";
                    //$link = "../controller/CtlParticipar.php?id=". $at->getId() ."";
                } else {
                    if ($inscrever == "Esgotado") {
                        $estilo = "botaoEsgotado";
                        $link = "../controller/CtlParticipar.php?id=". $at->getId() ."";
                    } else {
                        $estilo = "botaoInscrever";
                        $link = "javascript:func()' onclick='confirmacao(" . $at->getId() . ")";
                        //$link = "../controller/CtlParticipar.php?id=". $at->getId() ."";
                    }
                }
            }

            echo "<td class='linha-td' width='1200' align='middle' class='cssRow'>" . $at->getDataAtividade() . "</td>";
            echo "<td class='linha-td' width='1200' align='middle' class='cssRow'>" . $at->getHoraInicio() . "</td>";
            echo "<td class='linha-td' width='1200' align='middle' class='cssRow'>" . $at->getHoraTermino() . "</td>";
            echo "<td class='linha-td' width='1200' align='middle' class='cssRow'>" . $at->getLocal() . "</td>";
            //bucar nome do ministrante
            $ministrante = $daoM->abrir($at->getFk_ministrante());
            echo "<td class='linha-td' width='1200' align='middle' class='cssRow'>" . $ministrante->getNome() . "</td>";
            echo "<td class='linha-td' width='1200' align='middle' class='cssRow'>" . $ministrante->getFormacao() . "</td>";
            echo "<td  style='border: 5px;background:#fffffff;' class='linha-tdB'>
                          <a href='" . $link . "'>
                          <input type='button' value='" . $inscrever . "' class='" . $estilo . "'>
                      </a>
                 </td>";
            echo "</tr>";
            $at++;
            //    
             // <a href='". $link ."'  class='confirmacao'>
        }
        echo"<tr>";
        echo"<td colspan='9' style='background:#fffffff;'>";
        if ($daoMa->existteMatricula($_SESSION['id']) == true) {
            echo"<div class='csspdf'>";
            echo "<a href='../controller/CtlMatriculaPDF.php'  target='_blank'><img src='../presentation/image/pdf.gif'> Gerar matricula...</a>";
            echo "</div>";
        }
        echo"</td>";
        echo"</tr>";
        echo "</table>";
        ?>
        <?php
        //verifica se o usuario ja possui alguma matricula para que entao seja exibida a opção de gerar pdf
        ?>
        


    </body>
</html>
