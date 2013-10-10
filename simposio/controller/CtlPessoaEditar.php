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

include_once "../dataAccess/ConexaoDAO.php";
include_once "../dataAccess/PessoaDAO.php";
include_once "../domainModel/Pessoa.php";

$id = $_SESSION['id'];

if (!isset($_GET['at'])) {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $sexo = $_POST['sexo'];
    $nascimento = implode("-", array_reverse(explode("/", $_POST['nascimento'])));
    $instituicao = $_POST['instituicao'];
    $telefone = $_POST['fone'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    //-----
    if ((isset($_POST['complemento'])) != null) {
        $complemento = $_POST['complemento'];
    } else {
        $complemento = "vazio";
    }
    //-----
    if ($instituicao == 1) {
        $outraInstituicao = $_POST['novaIns'];
    } else {
        $outraInstituicao = "vazio";
    }
    //-----
    $cidade = $_POST['cidade'];


    //instacia classes
    $dao = new PessoaDAO();
    $pessoa = new Pessoa();

    $pessoa->setId($id);
    $pessoa->setNome($nome);
    $pessoa->setCpf($cpf);
    $pessoa->setNascimento($nascimento);
    $pessoa->setSexo($sexo);
    $pessoa->setFone($telefone);
    $pessoa->setRua($rua);
    $pessoa->setNumero($numero);
    $pessoa->setBairro($bairro);
    $pessoa->setComplemento($complemento);
    $pessoa->setNomeInstituicao($outraInstituicao);
    $pessoa->setFk_instituicao($instituicao);
    $pessoa->setFk_cidade($cidade);
    //$pessoa->setEmail($email);
    //$pessoa->setSenha($senha);


    if (!$dao->atualizar($pessoa)) {
        echo"<script language='javascript'>
                       window.location.href='../Presentation/main.php?pag=frmEditPessoa.php&atualiza=1'
                       </script>";
    } else {
        echo"<script language='javascript'>
                       window.location.href='../Presentation/main.php?pag=frmEditPessoa.php&atualiza=2'
                       </script>";
    }
} else {

    //instacia classes
    $dao = new PessoaDAO();
    $pessoa = new Pessoa();

    //Login
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $pessoa->setId($id);
    $pessoa->setEmail($email);
    $pessoa->setSenha($senha);

    if ($dao->verificarEmail($pessoa) == true) {
        if (!isset($_GET['ad'])) {
            echo"<script language='javascript'>
                               window.location.href='../presentation/main.php?pag=frmEditLogin.php&atualiza=0'
                               </script>";
        } else {
            echo"<script language='javascript'>
                               window.location.href='../presentation/administrator.php?pag=admLogin.php&atualiza=0'
                               </script>";
        }
    } else {
        if (!$dao->atualizarLogin($pessoa)) {
            if (!isset($_GET['ad'])) {
                echo"<script language='javascript'>
                               window.location.href='../Presentation/main.php?pag=frmEditLogin.php&atualiza=3'
                               </script>";
            } else {
                echo"<script language='javascript'>
                           window.location.href='../Presentation/administrator.php?pag=admLogin.php&atualiza=3'
                           </script>";
            }
        } else {
            if (!isset($_GET['ad'])) {
                echo"<script language='javascript'>
                            window.location.href='../Presentation/main.php?pag=frmEditLogin.php&atualiza=2'
                         </script>";
            } else {
                echo"<script language='javascript'>
                        window.location.href='../Presentation/administrator.php?pag=admLogin.php&atualiza=2'
                     </script>";
            }
        }
    }
}
?>

