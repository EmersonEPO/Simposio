
<?php
    include_once "../dataAccess/ConexaoDAO.php";
    include_once "../dataAccess/PessoaDAO.php";
    include_once "../domainModel/Pessoa.php";

    
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $sexo = $_POST['sexo'];
    $nascimento = implode("-",array_reverse(explode("/",$_POST['nascimento'])));
    $instituicao = $_POST['instituicao'];
    $telefone = $_POST['fone'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    //-----
    if(isset($_POST['complemento'])){
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
    $email = mysql_real_escape_string($_POST['email']);
    $senha = mysql_real_escape_string($_POST['senha']);
    
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
    
 
    if (!$dao->inserir($pessoa)) {
        
        
        
    } else {
        echo"<script language='javascript'> 
                   alert('Ocorreu um erro!') 
                   window.location.href='../Presentation/index.php'
                   </script>";
}
    
?>
