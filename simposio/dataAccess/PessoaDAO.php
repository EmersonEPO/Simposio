<?php

include_once "../dataAccess/ConexaoDAO.php";
include_once "../domainModel/Pessoa.php";


/*
 * @author emerson
 */

class PessoaDAO {

    //put your code here

    public function inserir(Pessoa $obj) {

        $query = sprintf("INSERT INTO pessoa(fk_instituicao,fk_cidade,email,senha,nivel,nome,cpf,sexo,nascimento,telefone,rua,numero,bairro,complemento,outraInstituicao,status) 
        VALUES('%s','%s','%s',SHA1('%s'),'%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',1)", $obj->getFk_instituicao(), $obj->getFk_cidade(), $obj->getEmail(), $obj->getSenha(), 1, $obj->getNome(), $obj->getCpf(), $obj->getSexo(), $obj->getNascimento(), $obj->getFone(), $obj->getRua(), $obj->getNumero(), $obj->getBairro(), $obj->getComplemento(), $obj->getNomeInstituicao());

        //iniciar conexao
        $daoConexao = new conexaoDAO();
        $conexaoAberta = $daoConexao->conectar();

        //selecionar banco
        $daoConexao->selecionarBanco();

        //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
        $daoConexao->executeQuery($query);

        //fecha conexao
        $daoConexao->desconectar($conexaoAberta);
    }

    //atualizar
    public function atualizar(Pessoa $obj) {
        $query = sprintf("UPDATE pessoa SET fk_instituicao='%s',fk_cidade='%s',nivel='%s',nome='%s',cpf='%s',sexo='%s',nascimento='%s',telefone='%s',rua='%s',numero='%s',bairro='%s',complemento='%s',outraInstituicao='%s',status='%s' WHERE idPessoa = '%s'", $obj->getFk_instituicao(), $obj->getFk_cidade(), 1, $obj->getNome(), $obj->getCpf(), $obj->getSexo(), $obj->getNascimento(), $obj->getFone(), $obj->getRua(), $obj->getNumero(), $obj->getBairro(), $obj->getComplemento(), $obj->getNomeInstituicao(), 1, $obj->getId());

        //iniciar conexao
        $daoConexao = new conexaoDAO();
        $conexaoAberta = $daoConexao->conectar();

        //selecionar banco
        $daoConexao->selecionarBanco();

        //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
        $daoConexao->executeQuery($query);

        //fecha conexao
        $daoConexao->desconectar($conexaoAberta);
    }

    //atualiza login
    public function atualizarLogin(Pessoa $obj) {
        $query = sprintf("UPDATE pessoa SET senha='%s' WHERE idPessoa = '%s'", sha1($obj->getSenha()), $obj->getId());

        //iniciar conexao
        $daoConexao = new conexaoDAO();
        $conexaoAberta = $daoConexao->conectar();

        //selecionar banco
        $daoConexao->selecionarBanco();

        //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
        $daoConexao->executeQuery($query);

        //fecha conexao
        $daoConexao->desconectar($conexaoAberta);
    }

    //Abrir
    public function abrir($id) {
        $query = sprintf("SELECT * FROM pessoa WHERE idPessoa = '%s' AND status = 1", $id);

        //iniciar conexao
        $daoConexao = new conexaoDAO();
        $conexaoAberta = $daoConexao->conectar();

        //selecionar banco
        $daoConexao->selecionarBanco();

        //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
        $rs = $daoConexao->executeQuery($query);

        //fecha conexao
        $daoConexao->desconectar($conexaoAberta);

        //Setando valores
        $pessoa = new Pessoa();

        while ($resultado = mysql_fetch_array($rs)) {
            $pessoa->setId(stripslashes($resultado['idPessoa']));
            $pessoa->setFk_instituicao(stripslashes($resultado['fk_instituicao']));
            $pessoa->setFk_cidade(stripslashes($resultado['fk_cidade']));
            $pessoa->setNome(stripslashes($resultado['nome']));
            $pessoa->setCpf(stripslashes($resultado['cpf']));
            $pessoa->setNascimento(implode("/", array_reverse(explode("-", $resultado['nascimento']))));
            $pessoa->setSexo(stripslashes($resultado['sexo']));
            $pessoa->setRua(stripslashes($resultado['rua']));
            $pessoa->setNumero(stripslashes($resultado['numero']));
            $pessoa->setFone(stripslashes($resultado['telefone']));
            $pessoa->setBairro(stripslashes($resultado['bairro']));
            $pessoa->setComplemento(stripslashes($resultado['complemento']));
            $pessoa->setNomeInstituicao(stripslashes($resultado['outraInstituicao']));
            $pessoa->setEmail(stripslashes($resultado['email']));
            $pessoa->setSenha(stripslashes($resultado['senha']));

            return $pessoa;
        }
    }

    //função que verifica se email já existe no sistema
    public function verificarEmail(Pessoa $obj) {
        $query = sprintf("SELECT COUNT(idPessoa) as ok FROM pessoa WHERE email LIKE '%s' AND idPessoa <> '%s' ", $obj->getEmail(), $obj->getId());

        //iniciar conexao
        $daoConexao = new conexaoDAO();
        $conexaoAberta = $daoConexao->conectar();

        //selecionar banco
        $daoConexao->selecionarBanco();

        //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
        $resultado = $daoConexao->executeQuery($query);

        //fecha conexao
        $daoConexao->desconectar($conexaoAberta);

        $query = mysql_fetch_assoc($resultado);

        if ($query['ok'] > 0) {
            return true;
        } else {
            return false;
        }
    }

}

?>
