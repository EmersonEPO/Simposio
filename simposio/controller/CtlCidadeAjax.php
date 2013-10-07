
<?php
    include('../dataAccess/ConexaoDAO.php');
    
    $estado = $_GET['estado'];
    $query = "SELECT * FROM cidade WHERE idEstado = $estado ORDER BY nome";
    
    //iniciar conexao
    $daoConexao = new conexaoDAO();
    $conexaoAberta = $daoConexao->conectar();

    //selecionar banco
    $daoConexao->selecionarBanco();

    //Persiste os dados, caso ocorra algum erro ocorre um mysql_error()
    $resultado = $daoConexao->executeQuery($query);

    //fecha conexao
    $daoConexao->desconectar($conexaoAberta);
       
    //numero de resultado encontrados
    $total = mysql_num_rows($resultado);
    
    for ($i = 0; $i < $total; $i++) {
      $dados = mysql_fetch_array($resultado);
      $arrCidades[$dados['idCidade']] = utf8_encode($dados['nome']);
    }
?>

<label class="labelRegistrar">Cidade:</label>
<select name="cidade" id="cidade" required="" class="cssCidade">
    <?php 
        foreach($arrCidades as $value => $nome){
            echo "<option value='{$value}'>{$nome}</option>";
        }
    ?>
</select>