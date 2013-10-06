<?php

    // A sessao precisa ser iniciada em cada pagina diferente
    if (!isset($_SESSION))
        session_start();
    $nivel_necessario = 1;
    // Verifica se não há a variavel da sessao que identifica o usuario
    if (!isset($_SESSION['email']) OR ($_SESSION['nivel'] < $nivel_necessario)) {
        // Destr?i a sess?o por seguran?a
        session_destroy();
        // Redireciona o visitante de volta pro login
        header("Location: ../presentation/index.php");
        exit; 
    }
?>


<?php
    include_once "../dataAccess/ControleDAO.php";
    include_once "../domainModel/Controle.php";
    include_once "../dataAccess/MatriculaDAO.php";

    $daoM = new MatriculaDAO();
    $dao = new ControleDAO();
    $novo = new Controle();

    $idAtividade = $_GET['id'];
    //pega o total de vagas normais e na lista de espera
    $novo = $dao->abrirtotal($idAtividade);
    
    //-----------
    //id pessoa
    $pessoa = $_SESSION['id'];

    //verifica se o usuario exedeu o limite maximo de matriculas
    //se for retornado true significa que o aluno ainda pode fazer matricula,
    //caso retorne false é porque o aluno atingiu o numero maximo de matriculas
    $max = 3; //numero maximo de matriculas que um aluno pode ter
    if (($daoM->totalMatricula($max,$pessoa)) == true) {

        //Verifica se o totol ainda esta dentro do aceitavel
        if (($novo->getTotalVaga() >= 0 ) and ($novo->getTotalVaga() < 2 )) {
            //acrescenta +1 na lista de vagas normais 
            $dao->acrescentarVaga($idAtividade);

            //id tipo matricula Vaga normal
            $tipo = 1;

            //realizar matricula
            $daoM->matricular($pessoa, $idAtividade, $tipo);
            //mensagem de resposta
            echo"<script language='javascript'>window.location.href='../presentation/main.php?pag=frmMinicurso.php&msg=1';</script>";
        } else {
            if (($novo->getTotalEspera() >= 0 ) and ($novo->getTotalEspera() < 5)) {
                //acrescenta +1 na lista de espera
                $dao->acrescentarEspera($idAtividade);

                //id tipo matricula Lista de Espera
                $tipo = 2;

                //realizar matricula
                $daoM->matricular($pessoa, $idAtividade, $tipo);
                //mensagem de resposta
                echo"<script language='javascript'>window.location.href='../presentation/main.php?pag=frmMinicurso.php&msg=2';</script>";
            } else {
                //mensagem de resposta
                echo"<script language='javascript'>window.location.href='../presentation/main.php?pag=frmMinicurso.php&msg=3';</script>";
            }
        }
    } else {
         //mensagem de resposta
         echo"<script language='javascript'>window.location.href='../presentation/main.php?pag=frmMinicurso.php&msg=4&max=". $max ."';</script>";
    }
?>
