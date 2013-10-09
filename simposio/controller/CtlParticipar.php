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
        
        if ($dao->choqueHorario($atv->getHoraInicio(), $atv->getHoraTermino(), $pessoa) == true) {
            $passe = 0;
            echo"<script language='javascript'>window.location.href='../presentation/main.php?pag=frmMinicurso.php&msg=alert';</script>";
        }
    }
    
    //pega o total de vagas normais e na lista de espera
    $novo = $dao->abrirtotal($idAtividade);
    
    //-----------
  
    //verifica se o usuario exedeu o limite maximo de matriculas
    //se for retornado true significa que o aluno ainda pode fazer matricula,
    //caso retorne false é porque o aluno atingiu o numero maximo de matriculas
    if($passe == 1){
    if (($daoM->totalMatricula($max,$pessoa)) == true) {

        //Verifica se o totol ainda esta dentro do aceitavel
        if (($novo->getTotalVaga() > 0 ) and ($novo->getTotalVaga() <= 2 )) {
            //retira -1 na lista de vagas normais 
            $dao->acrescentarVaga($idAtividade);

            //id tipo matricula Vaga normal
            $tipo = 1;

            //realizar matricula
            $daoM->matricular($pessoa, $idAtividade, $tipo);
            //mensagem de resposta
            echo"<script language='javascript'>window.location.href='../presentation/main.php?pag=frmMinicurso.php&msg=sucess';</script>";
        } else {
            if (($novo->getTotalEspera() > 0 ) and ($novo->getTotalEspera() <= 5)) {
                //acrescenta +1 na lista de espera
                $dao->acrescentarEspera($idAtividade);

                //id tipo matricula Lista de Espera
                $tipo = 2;

                //realizar matricula
                $daoM->matricular($pessoa, $idAtividade, $tipo);
                //mensagem de resposta
                echo"<script language='javascript'>window.location.href='../presentation/main.php?pag=frmMinicurso.php&msg=info';</script>";
            } else {
                //mensagem de resposta
                echo"<script language='javascript'>window.location.href='../presentation/main.php?pag=frmMinicurso.php&msg=ops';</script>";
            }
        }
    } else {
         //mensagem de resposta
         echo"<script language='javascript'>window.location.href='../presentation/main.php?pag=frmMinicurso.php&msg=atention';</script>";
    }
    }
?>
