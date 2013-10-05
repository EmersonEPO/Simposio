<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoAtividade
 *
 * @author Home
 */
class TipoAtividade {
    //put your code here
    private $id;
    private $nome;
    
    //construtor
    public function __construct() {
        $this->id = 0;
        $this->nome = "";
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
}

?>
