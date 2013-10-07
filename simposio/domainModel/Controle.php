<?php
    //A sessao precisa ser iniciada caso ela nao exista
    //para ser feito a comparação log mais
    if (!isset($_SESSION)) {
        session_start();
    }

    //Se o cokie criado apos o login não existir mais
    //significa que a sessao deve ser finalizada
    if(!isset($_COOKIE['expira'])){
        //detroi sessao
        session_destroy();
        //por segurança, estou destruindo também o cokie
        setcookie("expira");
        //mensagem informando que o tempo do usuario expirou, redireciona para index
        echo "<script language='javascript'>
                    window.location.href='../presentation/index.php?pag=frmLogin.php'
              </script>";
        
    }
    //nivel para ter acesso a essa pagina
    $nivel_necessario = 1;
    // Verifica se não há a variavel da sessao que identifica o usuario
    if (!isset($_SESSION['email']) OR ($_SESSION['nivel'] < $nivel_necessario)){
        //destroi a sessao por segurança
        session_destroy();
        //redireciona o visitante de volta pro login
        header("Location: ../presentation/index.php?pag=frmLogin.php"); exit;
    }
    
?>
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
