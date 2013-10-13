
<?php
    include_once "../dataAccess/ConexaoDAO.php";
    include_once "../dataAccess/PessoaDAO.php";
    include_once "../domainModel/Pessoa.php";

    
    
    
    
    $nome = $_POST['nome'];
   
    $sexo = $_POST['sexo'];
    $nascimento = implode("-",array_reverse(explode("/",$_POST['nascimento'])));
    $cpf = $_POST['cpf'];
    $instituicao = $_POST['instituicao'];
    $telefone = $_POST['fone'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    //-----
    if((isset($_POST['complemento'])) != null){
        $complemento = $_POST['complemento'];
    }else{
        $complemento = "vazio";
    }
    //-----
    if($instituicao == 1){
        $outraInstituicao = $_POST['novaIns'] ;
    }else{
        $outraInstituicao = "vazio";
    }
    //-----
    $cidade = $_POST['cidade'];
    //Login
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    //instacia classes
    $dao = new PessoaDAO();
    $pessoa = new Pessoa();
    
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
    $pessoa->setEmail($email);
    $pessoa->setSenha($senha);
    
    //verificar se cpf ja existe no sistema
    if($dao->verificarCpf($pessoa) == true){
        echo"<script language='javascript'> 
                   window.location.href='../Presentation/index.php?pag=frmCadastro.php&cpf'
                   </script>";    
    }else{
        //verificar se email ja existe no sistema
        if($dao->verificarEmail($pessoa) == true){
            echo"<script language='javascript'> 
                       window.location.href='../Presentation/index.php?pag=frmCadastro.php&email'
                       </script>";    
        }else{   
            //caso email e cpf ainda nao estajam no sistema sera efetuado o cadastro
            if (!$dao->inserir($pessoa)) {
                setcookie("email",$email,(time()+100));
                echo"<script language='javascript'>window.location.href='../Presentation/index.php?pag=frmLogin.php&sucess';</script>";          
            } else {
                echo"<script language='javascript'> 
                           alert('Ocorreu um erro!')window.location.href='../Presentation/index.php?pag=frmCadastro.php';</script>";
            }
        }
    }
    
    
?>
