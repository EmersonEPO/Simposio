<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
 
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style type="text/css" media="all">@import url(../style/reset.css);@import url(../style/generic.css);@import url(../style/style.css);</style> 
        
        <title>Dados Pessoais</title>
    </head>
   
    <body>
        <?php
        // put your code here
        ?>
        <div class="divNovaPessoa">
        <fieldset class="cssfielset">
            <legend></legend>
            
            <form name="formPessoa" id="formPessoa" method="POST" action="ctlPessoaCad.php">
                <!-- nome -->
                <label class="csslabel">Nome:</label>
                <input type="text" class="cssforminput" name="campoNome" id="nome" maxlength="100"><br/>
                <!-- cpf -->
                <label class="csslabel">Cpf:</label>
                <input type="text" class="cssforminput" name="cpf" id="cpf" required value="" maxlength="11"><br/>
                <!-- data nascimento -->
                <label class="csslabel">Nascimento:</label>
                <input type="text" class="cssforminput" name="nascimento" id="nascimento" required value="" maxlength="10"><br/>
                <!-- sexo -->
                <label class="csslabel">Sexo:</label>
                <select class="cssformselect" name="sexo" id="sexo" required>
                    <option value="" selected="">Selecione</option>
                    <option value="1">Masculino</option>
                    <option value="2">Feminino</option>
                </select><br/>
                <!-- instituicao -->
                <?php
                    include_once "../dataAccess/InstituicaoDAO.php";
                    include_once "../domainModel/Instituicao.php";

                    //instanciando obj
                    /*
                    $dao = new InstituicaoDAO();

                    $inst = new Instituicao();

                    $inst = $dao->listarTodos();*/

                    echo"<label class='csslabel'>Instituição:</label>";
                    echo"<select class='cssformselect' name='instituicao' id='instituicao' required>";
                        echo"<option value='' selected=''>Selecione</option>";
                        foreach ($inst as $i){
                            echo"<option value='".$i->getId()."'>".$i->getNome()."</option>";

                            $i++;
                        }
                    echo"</select>";
                ?>
                
                <label class="csslabel">Estado:</label>
                <select class="cssformselect" name="sexo" id="sexo" required>
                    <option value="" selected="">Selecione</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select>
                
                <label class="csslabel">Cidade:</label>
                <select class="cssformselect" name="sexo" id="sexo" required>
                    <option value="" selected="">Selecione</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select>
                
                <div>
                    <label class="csslabel">Instituicao:</label>
                    <input type="text" class="cssforminput" name="outraInstituicao" id="outraInstituicao" required value="" maxlength="100"><br/>
                </div> 
           
                <!-- nome -->
                <label class="csslabel">Rua:</label>
                <input type="text" class="cssforminput" name="nome" id="nome" required value="" maxlength="100"><br/>
                <!-- nome -->
                <label class="csslabel">Numero:</label>
                <input type="text" class="cssforminput" name="nome" id="nome" required value="" maxlength="100"><br/>
                <!-- nome -->
                <label class="csslabel">Bairro:</label>
                <input type="text" class="cssforminput" name="nome" id="nome" required value="" maxlength="100"><br/>
                <!-- nome -->
                <label class="csslabel">Cidade:</label>
                <input type="text" class="cssforminput" name="nome" id="nome" required value="" maxlength="100"><br/>
                <!-- nome -->
                <label class="csslabel">Complemento:</label>
                <input type="text" class="cssforminput" name="nome" id="nome" required value="" maxlength="100"><br/>
                
                <div class="divoption">
                    <a href=""><input type="submit" value="Salvar" name="salvar" id="salvar" class="salvarUser"></a>
                    <br>
                    <a href="../logout.php"><input type="button" value="Sair" name="sair" id="sair" class="salvarUser"></a>
                    <br>  
                </div>
            </form>
        </fieldset>
        </div>
    </body>
</html>
