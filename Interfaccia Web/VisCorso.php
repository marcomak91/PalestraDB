<?
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
<body class="visual">

<h2 align="center"> Corso</h2>
<table align="center" width="90%" CELLSPACING="30" class="vis"> 
<tr>
<td><b>CodiceCorso</b></td>
<td><b>Giorno</b></td>
<td><b>Tipo</b></td>
<td><b>PartecipantiMinimi</b></td>
<td><b>DataInizio</b></td>
<td><b>DataFine</b></td>
<td><b>CodIstruttore</b></td>
<td><b>NomeIstruttore</b></td>
<td><b>CognomeIstruttore</b></td>
</tr>
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT * FROM Personale NATURAL JOIN Istruttore JOIN Corso ON CodiceFiscale=CodIstruttore ORDER BY DataInizio") ;
while($cicle=mysql_fetch_array($query)){ 
    echo "<tr><td>".$cicle['CodCorso']."</td><td>".$cicle['Giorno']."</td><td>".$cicle['Tipo']."</td><td>".$cicle['PartecipantiMinimi']."</td><td>".$cicle['DataInizio']."</td><td>".$cicle['DataFine']."</td><td>".$cicle['CodiceFiscale']."</td><td>".$cicle['Nome']."</td><td>".$cicle['Cognome']."</td></tr>" ;  
} 
?> 
</table>
<form action="Visualizzazione.php" align="center">
<input type="submit" value="Back"/>
</form>
</body>
</html>
<?
}
?>