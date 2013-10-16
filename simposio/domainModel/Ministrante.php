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
    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    //----
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    //----
    public function setFormacao($formacao) {
        $this->formacao = $formacao;
    }

    public function getFormacao() {
        return $this->formacao;
    }

}
?>
