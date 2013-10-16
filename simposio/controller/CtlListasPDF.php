<?php

//A sessao precisa ser iniciada caso ela nao exista
//para ser feito a comparação log mais
if (!isset($_SESSION)) {
    session_start();
}
//nivel para ter acesso a essa pagina
$nivel_necessario = 2;
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

$id = $_GET['id'];

//obtendo dados do banco
$daoP = new PessoaDAO();
$daoA = new AtividadeDAO();

//---
$Pessoa = new Pessoa();
$atividade = new Atividade();

$pessoa = $daoP->listaTodos($id);

$atividade = $daoA->abrir($id);

//cria pagina em pdf
$pdf = new FPDF();
$pdf->AddPage('P', 'A4');

//CABEÇALHO DO RELATÓRIO
//Coloque aqui uma imagem como logo no seu relatório
//Se não precisar de imagem, apague essa linha
$pdf->Ln();
$pdf->Ln(20);


//CABEÇALHO DA TABELA
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(80);
$pdf->Cell(30, 10, $atividade->getNome(), 0, 0, 'C');
$pdf->Ln();
$pdf->Ln(5);

$pdf->Ln();

//POPULANDO A TABELA
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(78, 5, 'NOME', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(33, 5, 'CPF', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(56, 5, "ASSINATURA", 0, 0, 'C');
$pdf->Ln();
foreach ($pessoa as $row) {
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(80, 5, $row->getNome(), 1);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(30, 5, $row->getCpf(), 1);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(60, 5, "", 1);
    $pdf->Ln();
}

//FORÇA O DOWNLOAD PELO BROWSER
$pdf->Output('matriculaIFNMG.pdf', 'I');
?>
