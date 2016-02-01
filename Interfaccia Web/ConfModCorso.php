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
<?

include("connessione_db.php"); 
if (basename($_SERVER['HTTP_REFERER'])!='VisCorso.php?')

{$CodCorso=$_POST['CodCorso'];
$Giorno = $_POST['Giorno'];
$Tipo = $_POST['Tipo'];
$PartecipantiMinimi = $_POST['PartecipantiMinimi'];
$DataInizio = $_POST['DataInizio'];
$DataFine = $_POST['DataFine'];
$CodIstruttore = $_POST['CodIstruttore'];

$query=mysql_query("UPDATE Corso SET Giorno='$Giorno',Tipo='$Tipo', PartecipantiMinimi='$PartecipantiMinimi', DataInizio='$DataInizio', DataFine='$DataFine', CodIstruttore='$CodIstruttore' WHERE CodCorso='$CodCorso'"); 


if (!$query) {
	die("Errore nella query: " . mysql_error());}
}
?>
<h2>Aggiornamento Corso Avvenuto<br>Scegli Un' Operazione:</h2>
<table align="center"><tr>
<form action="VisCorso.php" align="left">
       <td><input type="submit" value="Visualizza"/></td>
</form>
<form action="HomeAmministrazione.php" align="left">
       <td><input type="submit" value="Home"/></td></tr></table>
</form>
</body>
</html>
<?php
}
?>
 
