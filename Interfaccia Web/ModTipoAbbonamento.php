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
<h2>Modifica Tipo Abbonamento</h2>
<?php

include("connessione_db.php"); 
$Durata=$_POST['Durata'];
$query = mysql_query("SELECT * FROM TipoAbbonamento WHERE Durata='$Durata'");
while($cicle=mysql_fetch_array($query)){

echo<<<END
<form action="ConfModTipoAbbonamento.php"  method="POST">
<input type="hidden" name="Durata" value="$Durata">
Prezzo: <input type="text" name="Prezzo" value="$cicle[Prezzo]"><br>
<br>
<table align="center"><tr><td><input type="submit" value="Modifica" /></td>
</form>
<form action="AggTipoAbbonamento.php" align="left">
       <td><input type="submit" value="Back"/></td></tr></table>
</form>

END;
}}
?> 
</body>
</html>
