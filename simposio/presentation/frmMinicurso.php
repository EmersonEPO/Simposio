<?php
    //A sessao precisa ser iniciada caso ela nao exista
    //para ser feito a comparação log mais
    if (!isset($_SESSION)) {
        session_start();
    }

    //Se o cokie criado apos o login não existir mais
    //significa que a sessao deve ser finalizada
    if (!isset($_COOKIE['expira'])) {
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
    if (!isset($_SESSION['email']) OR ($_SESSION['nivel'] < $nivel_necessario)) {
        //destroi a sessao por segurança
        session_destroy();
        //redireciona o visitante de volta pro login
        header("Location: ../presentation/index.php?pag=frmLogin.php");
        exit;
    }
?>
<?php
    //resolver problemas relacionado aos acentos
    header("Content-Type: text/html; charset=ISO-UTF-8", true);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <style type="text/css" media="all">
            @import url(style/reset.css);
            @import url(style/base.css);
            @import url(style/font.css);
            @import url(style/style.css);

            
            #cssmenu > ul > li {
                float: left;
                margin-left: 55px;
                margin-top: -16px;
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
            $data = "2013-10-09"; //data refente ao dia da semana
        }
        if (isset($_GET['Qui'])) {
            echo"<style type='text/css'> .cssAbaLink2{background: #e0e0e0;}</style>";
            $data = "2013-10-10"; //data refente ao dia da semana
        }
        if (isset($_GET['Sex'])) {
            echo"<style type='text/css'> .cssAbaLink3{background: #e0e0e0;}</style>";
            $data = "2013-10-11"; //data refente ao dia da semana
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
        $atividade = $daoA->listaTodos($data);

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
         $atv = $daoA->listarAtividadeDoUser($_SESSION['id']);
        ?>

        <!-- -->
        <div class="divLegenda">
            <img src="image/no.png"> Inscrever-se em alguma atividade<br/>
            <img src="image/es.png"> Inscrever-se na lista de espera<br/>
            <img src="image/er.png"> Todas as vagas foram preenchidas<br/>
            <img src="image/su.png"> Inscrito na atividadade<br/>
            <img src="image/pr.png"> Pré-inscrito na atividadade<br/>
           
            
        </div>

        <?php
            echo "<table name='tbl' id='tbl' border='1' class='cssTblAtividade'>";
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
            echo "<td width='600' align='middle' class='cssRow1'><b>DURAÇÃO</b></td>";
            echo "<td width='600' align='middle' class='cssRow1'><b>DATA</b></td>";
            echo "<td width='600' align='middle' class='cssRow1'><b>INICIO</b></td>";
            echo "<td width='600' align='middle' class='cssRow1'><b>TERMINO</b></td>";
            echo "<td width='600' align='middle' class='cssRow1'><b>LOCAL</b></td>";
            echo "<td width='600' align='middle' class='cssRow1'><b>MINISTRANTE</b></td>";
            echo "<td width='600' align='middle' class='cssRow1'><b>FORMAÇÃO</b></td>";
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
                $controle = $daoC->abrirtotal($at->getId());

                //se lista de vagas normais ainda contiver vagas
                if ($controle->getTotalVaga() > 0) {

                    //verificar se o usuario já se inscreveu em alguma disciplina
                    $atv2 = 0;
                    foreach ($atv as $atv2) {
                        if ($at->getId() == $atv2->getId()) {
                            $inscrever = "Inscrito";

                            break;
                        } else {
                            $inscrever = "Inscreva-se";
                        }
                        $atv2++;
                    }

                    //se lista de vagas normais NAO contiver vagas
                } else {
                    //verificar novamente se o usuario já se inscreveu em alguma disciplina 
                    $atv2 = 0;
                    foreach ($atv as $atv2) {
                        if ($at->getId() == $atv2->getId()) {
                            $inscrever = "Pré-inscrito";
                            break;
                        } else {
                            //se lista de espera ainda contiver vagas
                            if ($controle->getTotalEspera() > 0) {
                                $inscrever = "Espera";
                            } else {
                                $inscrever = "Esgotado";
                            }
                        }
                        $atv2++;
                    }
                }

                //if para mudar cor do botao
                if($inscrever == "Inscrito"){
                    $estilo = "botaoInscrito";
                    $link = "";
                }else{
                     if($inscrever == "Pré-inscrito"){
                            $estilo = "botaoPreInscrito";
                            $link = "";
                        }else
                    if($inscrever == "Espera"){
                        $estilo = "botaoEspera";
                        $link = "javascript:func()' onclick='confirmacao(" . $at->getId() . ")";
                        
                    }else{
                        if($inscrever == "Esgotado"){
                            $estilo = "botaoEsgotado";
                            $link = "";
                        }else{
                            $estilo = "botaoInscrever";
                            $link = "javascript:func()' onclick='confirmacao(" . $at->getId() . ")";
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

                echo "<td  style='border-color:#f2f2f2;background:#f2f2f2;' ><a href='".$link."'>
                      <input type='button' value='".$inscrever."' class='".$estilo."'>
                      </a></td>";

                echo "</tr>";
                $at++;
            }
            echo"<tr>";
                echo"<td colspan='9' style='border-color:#f2f2f2;background:#f2f2f2;'>";
                    if ($daoMa->existteMatricula($_SESSION['id']) == true) {
                        echo"<div class='csspdf'>";
                        echo "<a href='../controller/CtlMatriculaPDF.php'  target='_blank'><img src='../presentation/image/pdf.gif'> Gerar matricula de inscrição</a>";
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
