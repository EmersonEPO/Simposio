<?php

header('Content-Type: text/html; charset=iso-8859-1');
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

require_once '../domainModel/Atividade.php';
require_once '../dataAccess/AtividadeDAO.php';
require_once '../presentation/pdf/fpdf.php';
require_once '../domainModel/Pessoa.php';
require_once '../dataAccess/PessoaDAO.php';
require_once '../domainModel/Ministrante.php';
require_once '../dataAccess/MinistranteDAO.php';
require_once '../dataAccess/InstituicaoDAO.php';
require_once '../domainModel/Instituicao.php';
require_once '../dataAccess/MatriculaDAO.php';
require_once '../domainModel/Matricula.php';


//Recebe pela sessao o id da pessoa
$idPessoa = $_SESSION['id'];

//obtendo dados do banco
$daoA = new AtividadeDAO();
$novo = new Atividade();
//----
$daoP = new PessoaDAO();
$pessoa = new Pessoa();
//----
$daoM = new MinistranteDAO();
$ministrante = new Ministrante();
//----
$daoI = new InstituicaoDAO();
$instituicao = new Instituicao();
//----
$tipoMatricula = new Matricula();
$daoMat = new MatriculaDAO();

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
$pdf->Cell(30, 10, 'VII SIMPOSIO INFORMATICA', 0, 0, 'C');
$pdf->Ln();
$pdf->Ln(20);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(27, 5, 'NOME', 1);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(130, 5, $pessoa->getNome(), 1);
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(27, 5, 'CPF', 1);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(50, 5, $pessoa->getCpf(), 1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(27, 5, 'TELEFONE', 1);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(53, 5, $pessoa->getFone(), 1);
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(27, 5, 'EMAIL', 1);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(130, 5, $pessoa->getEmail(), 1);
$pdf->Ln();

if ($pessoa->getFk_instituicao() == 1) {
    $instituto = $pessoa->getNomeInstituicao();
} else {
    $instituto = $instituicao->getNome();
}

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(27, 5, 'INST.', 1);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(130, 5, $instituto, 1);



$pdf->Ln(10);

//CABEÇALHO DA TABELA
$pdf->SetFont('Arial', 'B', 10);

$pdf->Ln();


foreach ($novo as $row) {
    $ministrante = $daoM->abrir($row->getFk_ministrante());

    //tipo duração
    if ($row->getTipoDuracao() == 1) {
        $duracao = "Hora(s)";
    } else {
        $duracao = "Min.";
    }
    
    //ao invez de me retornar o id da matricula, isso me retornara o FK de tipo de matricula
    //1 = Inscrito
    //2 = Pre-incrito
    $tipoMatricula = $daoMat->abrir($pessoa->getId(), $row->getId());
    if ($tipoMatricula->getFk_tipo() == 1) {
        $tipoM = "Inscrito";
    } else {
        $tipoM = "Pre-inscrito";
    }

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(27, 5, 'TITULO', 1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(100, 5, $row->getNome(), 1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(30, 5, $tipoM, 1);
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(27, 5, 'CH', 1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(130, 5, $row->getDuracao() . " " . $duracao, 1);
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(27, 5, 'DATA', 1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(50, 5, $row->getDataAtividade(), 1);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(27, 5, 'HORARIO', 1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(53, 5, $row->getHoraInicio() . " - " . $row->getHoraTermino(), 1);
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(27, 5, 'LOCAL', 1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(130, 5, $row->getLocal(), 1);
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(27, 5, 'MINISTRANTE', 1);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(130, 5, $ministrante->getNome() . "  ( " . $ministrante->getFormacao() . " )", 1);
    $pdf->Cell(30, 5, "Visto:_________________", 0);
    $pdf->Ln(10);
}

//FORÇA O DOWNLOAD PELO BROWSER
$pdf->Output('matriculaIFNMG.pdf', 'I');
?>