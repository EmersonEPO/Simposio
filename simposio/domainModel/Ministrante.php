<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mnistrante
 *
 * @author Home
 */
class Ministrante {
    //put your code here
    private $id;
    private $nome;
    private $formacao;
    
    //contrutor
    public function __construct() {
        $this->id = 0;
        $this->nome = "";
        $this->formacao = "";
    }
    
    //metodos
    public function setId($id){
        $this->id = $id;
    }
    public function getId(){
        return $this->id;
    }
    //----
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function getNome(){
        return $this->nome;
    }
    //----
    public function setFormacao($formacao){
        $this->formacao = $formacao;
    }
    public function getFormacao(){
        return $this->formacao;
    }
}

?>
