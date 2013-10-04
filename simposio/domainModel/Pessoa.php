<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pessoa
 *
 * @author emerson
 */
class Pessoa{
    //put your code here
    private $id;
    private $nome;
    private $cpf;
    private $nascimento;
    private $fone;
    private $sexo;
    private $rua;
    private $numero;
    private $bairro;
    private $cidade;
    private $complemento;
    private $instituicao;
    private $nomeInstituicao;
    //user
    private $email;
    private $senha;
    private $status;
    
    //contrutor
    function __construct(){
        $this->id = 0;
        $this->nome = "";
        $this->cpf = 0;
        $this->nascimento = "";
        $this->fone = "";
        $this->sexo = "";
        $this->rua = "";
        $this->numero = 0;
        $this->bairro = "";
        $this->cidade = 0;
        $this->complemento = "";
        $this->instituicao = 0;
        $this->nomeInstituicao = "";
        //user
        $this->email = "";
        $this->senha = "";
        $this->status = 1;
      
    }
    
    //metodos
    public function setId($id){
        $this->id = addslashes($id);  
    }
    public function getId(){
        return $this->id;
    }
    //----
    public function setNome($nome){
        $this->nome = addslashes($nome);  
    }
    public function getNome(){
        return $this->nome;
    }
    //----
    public function setCpf($Cpf){
        $this->cpf = addslashes($Cpf);  
    }
    public function getCpf(){
        return $this->cpf;
    }
    //----
    public function setNascimento($nascimento){
        $this->nascimento = addslashes($nascimento);  
    }
    public function getNascimento(){
        return $this->nascimento;
    }
    //----
    public function setFone($fone){
        $this->fone = addslashes($fone);  
    }
    public function getFone(){
        return $this->fone;
    }
    //----
    public function setSexo($sexo){
        $this->sexo = addslashes($sexo);  
    }
    public function getSexo(){
        return $this->sexo;
    }
    //----
    public function setRua($rua){
        $this->rua = addslashes($rua);  
    }
    public function getRua(){
        return $this->rua;
    }
    //----
    public function setNumero($numero){
        $this->numero = addslashes($numero);  
    }
    public function getNumero(){
        return $this->numero;
    }
    //----
    public function setBairro($bairro){
        $this->bairro = addslashes($bairro);  
    }
    public function getBairro(){
        return $this->bairro;
    }
    //----
    public function setComplemento($complemento){
        $this->complemento = addslashes($complemento);  
    }
    public function getComplemento(){
        return $this->complemento;
    }
    //----
    public function setFk_cidade($cidade){
        $this->cidade = addslashes($cidade);  
    }
    public function getFk_cidade(){
        return $this->cidade;
    }
    //----
    public function setFk_instituicao($instituicao){
        $this->instituicao = addslashes($instituicao);  
    }
    public function getFk_instituicao(){
        return $this->instituicao;
    }
    //----
    public function setNomeInstituicao($nomeInstituicao){
        $this->nomeInstituicao = addslashes($nomeInstituicao);  
    }
    public function getNomeInstituicao(){
        return $this->nomeInstituicao;
    }
    //email
    public function setEmail($email){
        $this->email = addslashes($email);
    }
    public function getEmail(){
        return $this->email;
    }
    //senha
    public function setSenha($senha){
        $this->senha = addslashes($senha);
    }
    public function getSenha(){
        return $this->senha;
    }
   
}

?>
