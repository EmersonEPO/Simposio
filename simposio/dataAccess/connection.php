<?php
    
    $user = "root";
    $passwd = "epo123";
    $server = "localhost";
    $banco = "bdevento";
    
    $connection = mysql_connect($server,$user,$passwd);
    $db = mysql_select_db($banco,$connection);
    
          
?>
