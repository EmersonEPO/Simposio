<?php

include_once "../dataAccess/ConexaoDAO.php";
include_once "../domainModel/Pessoa.php";

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pessoaDAO
 *
 * @author emerson
 */
class PessoaDAO {

    //put your code here

    public function inserir(Pessoa $obj) {
        $query = sprintf("INSERT INTO pessoa(fk_instituicao,fk_cidade,email,senha,nivel,nome,cpf,sexo,nascimento,telefone,rua,numero,bairro,complemento,outraInstituicao,status) 
       VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s',1)", $obj->getFk_instituicao(), $obj->getFk_cidade(), $obj->getEmail(), $obj->getSenha(), 1, $obj->getNome(), $obj->getCpf(), $obj->getSexo(), $obj->getNascimento(), $obj->getFone(), $obj->getRua(), $obj->getNumero(), $obj->getBairro(), $obj->getComplemento(), $obj->getNomeInstituicao());

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
        $resultado = $daoConexao->executeQuery($query);

        //fecha conexao
        $daoConexao->desconectar($conexaoAberta);

        //Setando valores
        $pessoa = new Pessoa();

        $pessoa->setId($resultado['idPessoa']);
        $pessoa->setIdUser($resultado['fk_usuario']);
        $pessoa->setFk_instituicao($resultado['fk_instituicao']);
        $pessoa->setFk_cidade($resultado['fk_cidade']);
        $pessoa->setNome($resultado['nome']);
        $pessoa->setCpf($resultado['cpf']);
        $pessoa->setNascimento(implode("/", array_reverse(explode("-", $resultado['nascimento']))));
        $pessoa->setSexo($resultado['sexo']);
        $pessoa->setRua($resultado['rua']);
        $pessoa->setNumero($resultado['numero']);
        $pessoa->setBairro($resultado['bairro']);
        $pessoa->setId($resultado['complemento']);
        $pessoa->setNomeInstituicao($resultado['outraInsituicao']);

        return $pessoa;
    }

    //função que verifica se email já existe no sistema
    public function verificarEmail($email) {
        $query = sprintf("SELECT COUNT(idPessoa) as ok FROM usuario WHERE email LIKE '%s'", $email);

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

        if ($query['ok'] == 1) {
            return true;
        } else {
            return false;
        }
    }

}

?>
