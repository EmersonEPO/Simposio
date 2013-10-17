<?php

//A sessao precisa ser iniciada caso ela nao exista
//para ser feito a comparação log mais
if (!isset($_SESSION)) {
    session_start();
}
//nivel para ter acesso a essa pagina
$nivel_necessario = 1;
// Verifica se não há a variavel da sessao que identifica o usuario
if (!isset($_SESSION['email']) OR ($_SESSION['nivel'] < $nivel_necessario)) {
    //destroi a sessao por segurança
    session_destroy();
    //redireciona o visitante de volta pro login
    header("Location: ../presentation/index.php?pag=frmLogin.php");
    exit;
}
?>

<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Matricula
 *
 * @author Home
 */
class Matricula {

    //put your code here
    private $id;
    private $fk_atividade;
    private $fk_pessoa;
    private $fk_tipo;

    //construtor
    public function __construct() {
        $this->id = 0;
        $this->fk_atividade = 0;
        $this->fk_pessoa = 0;
        $this->fk_tipo = 0;
    }

    //metodos
    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setFk_atividade($fk_atividade) {
        $this->fk_atividade = $fk_atividade;
    }

    public function getFk_atividade() {
        return $this->fk_atividade;
    }

    public function setFk_pessoa($fk_pessoa) {
        $this->fk_pessoa = $fk_pessoa;
    }

    public function getFk_pessoa() {
        return $this->fk_pessoa;
    }

    public function setFk_tipo($fk_tipo) {
        $this->fk_tipo = $fk_tipo;
    }

    public function getFk_tipo() {
        return $this->fk_tipo;
    }

}

?>
