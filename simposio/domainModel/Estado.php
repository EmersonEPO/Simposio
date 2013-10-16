<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Estado
 *
 * @author emerson
 */
class Estado {

    //put your code here
    private $nome;
    private $id;
    private $sigla;

    //construtor
    public function __construct() {
        $this->id = 0;
        $this->nome = "";
        $this->sigla = "";
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
    public function setSigla($sigla) {
        $this->sigla = addslashes($sigla);
    }

    public function getSigla() {
        return $this->sigla;
    }

}

?>
