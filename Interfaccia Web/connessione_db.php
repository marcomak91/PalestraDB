<?php

$connessione=mysql_connect('localhost:3306', 'root', 'YH7AvWK!')
  or die($_SERVER['PHP_SELF'] . "Connessione fallita!");
  
mysql_select_db('Progetto', $connessione);

?>
