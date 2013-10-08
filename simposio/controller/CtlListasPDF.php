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
    $nivel_necessario = 2;
    // Verifica se não há a variavel da sessao que identifica o usuario
    if (!isset($_SESSION['email']) OR ($_SESSION['nivel'] < $nivel_necessario)){
        //destroi a sessao por segurança
        session_destroy();
        //redireciona o visitante de volta pro login
        header("Location: ../presentation/index.php?pag=frmLogin.php"); exit;
    }
    
?>

<?php
require_once '../domainModel/Atividade.php';
require_once '../dataAccess/AtividadeDAO.php';
require_once '../presentation/pdf/fpdf.php';
require_once '../domainModel/Pessoa.php';
require_once '../dataAccess/PessoaDAO.php';
require_once '../domainModel/Ministrante.php';
require_once '../dataAccess/MinistranteDAO.php';
require_once '../dataAccess/InstituicaoDAO.php';
require_once '../domainModel/Instituicao.php';


//Recebe pela sessao o id da pessoa
$idPessoa = $_SESSION['id'];

//obtendo dados do banco
$daoA = new AtividadeDAO();
$novo = new Atividade();
$daoP = new PessoaDAO();
$pessoa = new Pessoa();
$daoM = new MinistranteDAO();
$ministrante = new Ministrante();
$daoI = new InstituicaoDAO();
$instituicao = new Instituicao();

$novo = $daoA->listarAtividadeDoUser($idPessoa);

$pessoa = $daoP->abrir($idPessoa);
$ministrante = $daoM->abrir(2);

$instituicao = $daoI->abrir($pessoa->getFk_instituicao());

//cria pagina em pdf
$pdf = new FPDF();
$pdf->AddPage('P', 'A4');

//CABEÇALHO DO RELATÓRIO
//Coloque aqui uma imagem como logo no seu relatório
//Se não precisar de imagem, apague essa linha
$pdf->Image('../presentation/image/logo.jpg', 70);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(80);
$pdf->Cell(30, 10, 'VI SIMPOSIO INFORMATICA', 0, 0, 'C');
$pdf->Ln();
$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(11, 5,'NOME:', 0, 0, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(29, 5,$pessoa->getNome(), 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(210,5,'FONE:', 0, 0, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(-168,5,$pessoa->getFone(), 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(7,4,'CPF:', 0, 0, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(39, 4,$pessoa->getCpf(), 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(11,5,'EMAIL:', 0, 0, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(37,5,$pessoa->getEmail(), 0, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(28,5,'INSTITUIÇÃO:', 0, 0, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(29,5,  strtoupper($instituicao->getNome()), 0, 0, 'C');


$pdf->Ln(10);

//CABEÇALHO DA TABELA
$pdf->SetFont('Arial', 'B', 10);

$pdf->Ln();

//POPULANDO A TABELA
$pdf->SetFont('Arial', '', 8);
foreach ($novo as $row) {
    $ministrante = $daoM->abrir($row->getFk_ministrante());

    //tipo duração
    if ($row->getTipoDuracao() == 1) {
        $duracao = "Hora(s)";
    } else {
        $duracao = "Min.";
    }
    
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(27, 5, 'TITULO', 1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(130, 5, $row->getNome(), 1);
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(27, 5, 'DURAÇAO', 1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(130, 5,$row->getTipoDuracao()." ".$duracao, 1);
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(27, 5, 'DATA', 1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(50, 5, $row->getDataAtividade(), 1);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(27, 5, 'HORARIO', 1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(53, 5, $row->getHoraInicio()." - ".$row->getHoraTermino(), 1);
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(27, 5, 'LOCAL', 1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(130, 5, $row->getLocal(), 1);
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(27, 5, 'MINISTRANTE', 1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(130, 5, $ministrante->getNome()."  ( ".$ministrante->getFormacao()." )", 1);
    $pdf->Cell(30, 5,"Visto:_________________", 0);
    $pdf->Ln(10);
}

//FORÇA O DOWNLOAD PELO BROWSER
$pdf->Output('matriculaIFNMG.pdf', 'I');
?>