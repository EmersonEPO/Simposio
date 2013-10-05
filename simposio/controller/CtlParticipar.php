<?php
    include_once "../dataAccess/ControleDAO.php";
    include_once "../domainModel/Controle.php";
    include_once "../dataAccess/MatriculaDAO.php";

    $dao = new ControleDAO();
    $novo = new Controle();

    $idAtividade = $_GET['idAtividade'];

    $novo = $dao->abrirtotal($idAtividade);

    //Verifica se o totol ainda esta dentro do aceitavel
    if (($novo->getTotalVaga() >= 0 ) or ($novo->getTotalVaga() <= 30 )) {
        //acrescenta +1 na lista de vagas normais 
        $dao->acrescentarVaga($idAtividade);


        //id pessoa
        $pessoa = $_SESSION['id'];
        //id atividade
        $atividade = $idAtividade;
        //id tipo matricula
        $tipo = 1;

        //realizar matricula
        $daoM->matricular($pessoa, $atividade, $tipo);
    } else {
        if (($novo->getTotalEspera() >= 0 ) or ($novo->getTotalEspera() <= 5)) {
            //acrescenta +1 na lista de espera
            $dao->acrescentarEspera($idAtividade);

            //matricula
            $daoM = new MatriculaDAO();

            //id pessoa
            $pessoa = $_SESSION['id'];
            //id atividade
            $atividade = $idAtividade;
            //id tipo matricula
            $tipo = 2;

            //realizar matricula
            $daoM->matricular($pessoa, $atividade, $tipo);
        } else {
            echo "sentimos informa-lo que as todas as vagas para esta atividade foram preenchidas";
        }
    }
?>
