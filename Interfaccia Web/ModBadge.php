<?php
/* attiva la sessione */
session_start();
/* verifica se la variabile ‘login’ e` settata */
$login=$_SESSION['login'];
if (empty($login)) {
 /* non passato per il login: accesso non autorizzato ! */
 echo "Impossibile accedere. Prima effettuare il login.";
} else {
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Palestra The Gym</title>
    <meta name="title" content="Palestra The Gym" />
    <meta name="description" content="Home Page del sito di The Gym" />
    <meta name="language" content="ïtalian it" />
    <meta name="Author" content="Munaro Michael, Prelaz Marco" />
    <link rel="stylesheet" type="text/css" href="style.css"/>

</head>
<body class="bcenter">
<h2>Modifica Badge</h2>

<?php

include("connessione_db.php"); 
$CodAbbonato=$_POST['CodAbbonato'];
$query = mysql_query("SELECT * FROM Badge WHERE CodAbbonato='$CodAbbonato'"); 
while($cicle=mysql_fetch_array($query)){
echo<<<END
 <form action="ConfModBadge.php"  method="POST">
 <input type="hidden" name="CodAbbonato" value="$CodAbbonato">
 DataInizio: <input type="date" name="DataInizio" value="$cicle[DataInizio]"><br />
 Durata: <select name="Durata">
  <option>$cicle[Durata]</option>
END;
 $durata=mysql_query("SELECT * FROM TipoAbbonamento");
  while($ciclo=mysql_fetch_array($durata)){
  	if ($ciclo['Durata']!=$cicle['Durata']){
  echo<<<END
  <option>$ciclo[Durata]</option>   
END;
}
}
echo<<<END
</select>
 <table align="center"><tr><td><input type="submit" value="Modifica" /></td>
</form>
<form action="AggBadge.php" align="left">
       <td><input type="submit" value="Back"/></td></tr><table>
</form>
END;
}}

?> 
</body>
</html>