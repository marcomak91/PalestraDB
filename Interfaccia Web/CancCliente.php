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
<body class="bcenter">
<h2>Cancellazione Cliente <h2>
<table align="center"><tr>
<form action="EliminaCliente.php"  method="POST">
<td>
CodiceFiscale:
<select name="CodiceFiscale">
<?php 
include("connessione_db.php"); 

$query = mysql_query("SELECT CodiceFiscale FROM Cliente"); 
while($cicle=mysql_fetch_array($query)){ 
    echo "<option>".$cicle['CodiceFiscale']."</option>" ;  
} 
?>
</select>
</td><td>
<input type="submit" value="Elimina" /> </td>
</form>
<form action="Cancellazione.php" >
<td><input type="submit" value="Back" /></td></tr>
</form>
</body>
</html> 

<?
}
?>
 

