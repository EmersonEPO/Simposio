
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Instituicao
 *
 * @author emerson
 */
class Instituicao {
    //put your code here
    private $id;
    private $nome;
    
    //construtor
    public function __construct() {
        $this->id = 0;
        $this->nome = "";
    }
    
    //metodos
    
    //id
    public function setId($id){
        $this->id = addslashes($id);
    }
    public function getId(){
        return $this->id;
    }
    //nome
    public function setNome($nome){
        $this->nome = addslashes($nome);
    }
    public function getNome(){
        return $this->nome;
    }
}

?>
