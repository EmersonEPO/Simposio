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
<?php

include_once "../dataAccess/ControleDAO.php";
include_once "../domainModel/Controle.php";
include_once "../dataAccess/MatriculaDAO.php";
include_once "../domainModel/Atividade.php";
include_once "../dataAccess/AtividadeDAO.php";

$passe = 1;
//id pessoa
$pessoa = $_SESSION['id'];
//numero maximo de matriculas que um aluno pode ter
$max = 3;
//id Atividade
$idAtividade = $_GET['id'];

$daoA = new AtividadeDAO();
$atv = new Atividade();
$daoM = new MatriculaDAO();
$dao = new ControleDAO();
$novo = new Controle();

//verificar se usuario possui alguma matricula
if ($daoM->existteMatricula($pessoa) == true) {
    //verificar se nao ocorreu choque de horario.
    $atv = $daoA->abrir($idAtividade);
    $data = implode("-", array_reverse(explode("/", $atv->getDataAtividade())));
    
    if ($dao->choqueHorario($atv->getHoraInicio(), $atv->getHoraTermino(), $data, $pessoa) == true) {
        $passe = 0;
        echo"<script language='javascript'>window.location.href='../presentation/main.php?pag=frmMinicurso.php&msg=alert&Qua';</script>";
    }
}

//pega o total de vagas normais e na lista de espera
$novo = $dao->abrirtotal($idAtividade);

//-----------
//ATENTION/ ATENÇÃO { AQUI FICAM A QUANTIDADE DE MATRICULAS QUE O SISTEMA ACEITARA SEREM FEITAS }
$total_vagas_normais = 30;
$total_vagas_espera = 5;

//verifica se o usuario exedeu o limite maximo de matriculas
//se for retornado true significa que o aluno ainda pode fazer matricula,
//caso retorne false é porque o aluno atingiu o numero maximo de matriculas
if ($passe == 1) {
    if (($daoM->totalMatricula($max, $pessoa)) == true) {

        //Verifica se o totol ainda esta dentro do aceitavel
        if (($novo->getTotalVaga() > 0 ) and ($novo->getTotalVaga() <= $total_vagas_normais )) {

            //id tipo matricula Vaga normal
            $tipo = 1;

            //retira -1 na lista de vagas normais e faz matricula
            $dao->acrescentarVaga($pessoa, $idAtividade, $tipo);

            //mensagem de resposta
            echo"<script language='javascript'>window.location.href='../presentation/main.php?pag=frmMinicurso.php&msg=sucess&Qua';</script>";
        } else {
            if (($novo->getTotalEspera() > 0 ) and ($novo->getTotalEspera() <= $total_vagas_espera )) {

                //id tipo matricula Lista de Espera
                $tipo = 2;

                //retira -1 na lista de espera e faz matricula
                $dao->acrescentarEspera($pessoa, $idAtividade, $tipo);

                //mensagem de resposta
                echo"<script language='javascript'>window.location.href='../presentation/main.php?pag=frmMinicurso.php&msg=important&Qua';</script>";
            } else {
                //mensagem de resposta
                echo"<script language='javascript'>window.location.href='../presentation/main.php?pag=frmMinicurso.php&msg=info&Qua';</script>";
            }
        }
    } else {
        //mensagem de resposta
        echo"<script language='javascript'>window.location.href='../presentation/main.php?pag=frmMinicurso.php&msg=atention&Qua';</script>";
    }
}
?>
