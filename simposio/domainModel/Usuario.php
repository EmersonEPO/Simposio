<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author emerson
 */
class Usuario extends Pessoa{
    // Objetos
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $status;
    
    // Construtor
    function __construct() {
        $this->id = 0;
        $this->nome = "";
        $this->email = "";
        $this->senha = "";
        $this->status = 1;
    }
    
    // Metodos Set e Get
    //id
    public function setId($id){
        $this->id = addslashes($id);
    }
    public function getId(){
        return $this->id;
    }
    //nome
    public function setUsuario($nome){
        $this->nome = addslashes($nome);
    }
    public function getUsuario(){
        return $this->nome;
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
    //status
    public function setStatus($status){
        $this->status = addslashes($status);
    }
    public function getStatus(){
        return $this->status;
    }
}

?>
