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
<?php

include("connessione_db.php"); 
$CodiceFiscale = $_POST['CodiceFiscale'];
$Password = $_POST['Password'];

$query=mysql_query("UPDATE Segretario SET Password='$Password' WHERE CodiceFiscale='$CodiceFiscale'"); 

if (!$query) {
	die("Errore nella query: " . mysql_error());}
else{
?>
<h2>Aggiornamento Segretario Avvenuto<br>Scegli Un' Operazione:<h2>
<table align="center">
<form action="VisSegretario.php" align="left">
       <tr><td><input type="submit" value="Visualizza"/></td>
</form>
<form action="HomeAmministrazione.php" align="left">
       <td><input type="submit" value="Home"/></td></tr></table>
</form> 
</body>
</html>
<?php
}}
?> 
