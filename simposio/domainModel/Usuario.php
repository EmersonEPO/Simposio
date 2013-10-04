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
class Usuario{
    // Objetos
    private $id;
    private $nome;
   
    
    // Construtor
    function __construct() {
        $this->idUser = 0;
        $this->nome = "";
      
    }
    
    // Metodos Set e Get
    //id
    public function setIdUser($id){
        $this->idUser = addslashes($id);
    }
    public function getIdUser(){
        return $this->idUser;
    }
    //nome
    public function setUsuario($nome){
        $this->nome = addslashes($nome);
    }
    public function getUsuario(){
        return $this->nome;
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
