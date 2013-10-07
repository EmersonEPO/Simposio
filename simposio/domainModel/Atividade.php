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
 * Description of Atividade
 *
 * @author Home
 */
class Atividade {
    //put your code here
    private $id;
    private $nome;
    private $tipoDuracao;
    private $duracao;
    private $dataAtividade;
    private $horaInicio;
    private $horaTermino;
    private $local;
    //-----
    private $fk_evento;
    private $fk_tipoAtv;
    private $fk_ministrante;
    
    //construtor
    public function __construct() {
        $this->id = 0;
        $this->nome = "";
        $this->tipoDuracao = 0;
        $this->duracao = 0;
        $this->dataAtividade = 0;
        $this->horaInicio = 0;
        $this->horaTermino = 0;
        $this->local = "";
        
        //-----
        $this->fk_evento = 0;
        $this->fk_tipoAtv = 0;
        $this->fk_ministrante = 0;
    }
    
    //metodos
    public function setId($id){
        $this->id = addslashes($id);  
    }
    public function getId(){
        return $this->id;
    }
    //----
    public function setNome($nome){
        $this->nome = addslashes($nome);  
    }
    public function getNome(){
        return $this->nome;
    }
    //----
    public function setTipoDucacao($tipoDuracao){
        $this->tipoDuracao = addslashes($tipoDuracao);  
    }
    public function getTipoDuracao(){
        return $this->tipoDuracao;
    }
    //----
    public function setDuracao($duracao){
        $this->duracao = addslashes($duracao);  
    }
    public function getDuracao(){
        return $this->duracao;
    }
    //----
    public function setDataAtividade($dataAtividade){
        $this->dataAtividade = addslashes($dataAtividade);  
    }
    public function getDataAtividade(){
        return $this->dataAtividade;
    }
    //----
    public function setHoraInicio($horaInicio){
        $this->horaInicio = addslashes($horaInicio);  
    }
    public function getHoraInicio(){
        return $this->horaInicio;
    }
    //----
    public function setHoraTermino($horaTermino){
        $this->horaTermino = addslashes($horaTermino);  
    }
    public function getHoraTermino(){
        return $this->horaTermino;
    }
    //----
    public function setLocal($local){
        $this->local = addslashes($local);  
    }
    public function getLocal(){
        return $this->local;
    }
    //----
    public function setFk_evento($evento){
        $this->fk_evento = addslashes($evento);  
    }
    public function getFk_evento(){
        return $this->fk_evento;
    }
    //----
    public function setFk_ministrante($ministrante){
        $this->fk_ministrante = addslashes($ministrante);  
    }
    public function getFk_ministrante(){
        return $this->fk_ministrante;
    }
    //----
    public function setFk_tipoAtv($tipoAtv){
        $this->fk_tipoAtv = addslashes($tipoAtv);  
    }
    public function getFk_tipoAtv(){
        return $this->fk_tipoAtv;
    }

}

?>
