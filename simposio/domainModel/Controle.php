<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controle
 *
 * @author Home
 */
class Controle {
    //put your code here
    private $id;
    private $totalVaga;
    private $totalEspera;
    
    private $fk_atividade;
    
    //construtor
    public function __construct() {
        $this->id = 0;
        $this->totalVaga = 0;
        $this->totalEspera = 0;
        $this->fk_atividade = 0;
    }
    
    //metodos
    public function setId($id) {
        $this->id = addslashes($id);
    }
    public function getId() {
        return $this->id;
    }
    //----
    public function setTotalVaga($totalVaga) {
        $this->totalVaga = addslashes($totalVaga);
    }
    public function getTotalVaga() {
        return $this->totalVaga;
    }
    //----
    public function setTotalEspera($totalEspera) {
        $this->totalEspera = addslashes($totalEspera);
    }
    public function getTotalEspera() {
        return $this->totalEspera;
    }
    //----
    public function setFk_atividade($atividade) {
        $this->fk_atividade = addslashes($atividade);
    }
    public function getFk_atividade() {
        return $this->fk_atividade;
    }
}

?>
