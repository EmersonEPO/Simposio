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
class Pessoa {
    //put your code here
    private $id;
    private $nome;
    private $cpf;
    private $nascimento;
    private $sexo;
    private $rua;
    private $numero;
    private $bairro;
    private $cidade;
    private $complemento;
    private $instituicao;
    
    //contrutor
    function __construct(){
        $this->id = 0;
        $this->nome = "";
        $this->cpf = 0;
        $this->nascimento = "";
        $this->sexo = "";
        $this->rua = "";
        $this->numero = 0;
        $this->bairro = "";
        $this->cidade = 0;
        $this->complemento = "";
        $this->instituicao = 0;
    }
    
    //metodos
    public function setId($id){
        $this->id = addcslashes($id);  
    }
    public function getId(){
        return $this->id;
    }
    //----
    public function setNome($nome){
        $this->nome = addcslashes($nome);  
    }
    public function getNome(){
        return $this->nome;
    }
    //----
    public function setCpf($Cpf){
        $this->cpf = addcslashes($Cpf);  
    }
    public function getCpf(){
        return $this->cpf;
    }
    //----
    public function setNascimento($nascimento){
        $this->nascimento = addcslashes($nascimento);  
    }
    public function getNascimento(){
        return $this->nascimento;
    }
    //----
    public function setSexo($sexo){
        $this->sexo = addcslashes($sexo);  
    }
    public function getSexo(){
        return $this->sexo;
    }
    //----
    public function setRua($rua){
        $this->rua = addcslashes($rua);  
    }
    public function getRua(){
        return $this->rua;
    }
    //----
    public function setNumero($numero){
        $this->numero = addcslashes($numero);  
    }
    public function getNumero(){
        return $this->numero;
    }
    //----
    public function setBairro($bairro){
        $this->bairro = addcslashes($bairro);  
    }
    public function getBairro(){
        return $this->bairro;
    }
    //----
    public function setComplemento($complemento){
        $this->complemento = addcslashes($complemento);  
    }
    public function getComplemento(){
        return $this->complemento;
    }
    //----
    public function setFk_cidade($cidade){
        $this->cidade = addcslashes($cidade);  
    }
    public function getFk_cidade(){
        return $this->cidade;
    }
    //----
    public function setFk_instituicao($instituicao){
        $this->instituicao = addcslashes($instituicao);  
    }
    public function getFk_instituicao(){
        return $this->instituicao;
    }
    
}

?>
