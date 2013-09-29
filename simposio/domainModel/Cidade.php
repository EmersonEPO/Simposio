<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cidade
 *
 * @author emerson
 */
class Cidade {
    //put your code here
    private $id;
    private $nome;
    private $idEstado;

    //construtor
    function __construct() {
        $this->id = 0;
        $this->nome = "";
        $this->idEstado = 0;
    }

    //metodos
    public function setId($id) {
        $this->id = addslashes($id);
    }
    public function getId() {
        return $this->id;
    }
    //----
    public function setNome($nome) {
        $this->nome = addslashes($nome);
    }
    public function getNome() {
        return $this->nome;
    }

    //----
    public function setIdEstado($id) {
        $this->idEstado = addslashes($id);
    }
    public function getIdEstado() {
        return $this->idEstado;
    }
    
}

?>
