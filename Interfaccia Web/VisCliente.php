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
<h2 align="center"> Cliente</h2>
<table align="center" width="90%" CELLSPACING="30" class="vis"> 
<tr>
<td><b>CodiceFiscale</b></td>
<td><b>Nome</b></td>
<td><b>Cognome</b></td>
<td><b>DataNascita</b></td>
<td><b>LuogoNascita</b></td>
<td><b>Indirizzo</b></td>
<td><b>Sesso</b></td>
<td><b>Telefono</b></td>
<td><b>CodPersonalTrainer</b></td>
</tr>
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT * FROM Cliente"); 
while($cicle=mysql_fetch_array($query)){ 
    echo "<tr><td>".$cicle['CodiceFiscale']."</td><td>".$cicle['Nome']."</td><td>".$cicle['Cognome']."</td><td>".$cicle['DataNascita']."</td><td>".$cicle['LuogoNascita']."</td><td>".$cicle['Indirizzo']."</td><td>".$cicle['Sesso']."</td><td>".$cicle['Telefono']."</td><td>".$cicle['CodPersonalTrainer']."</td></tr>" ;  
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