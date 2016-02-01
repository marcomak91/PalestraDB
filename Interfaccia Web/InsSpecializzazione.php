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
<h2>Inserimento Specializzazione Istruttore</h2>

<form action="InsSpecializzazione2.php" method="POST">

		Istruttore: 
		<select name="Istruttore">
		<?php 
		include("connessione_db.php"); 
		$query = mysql_query("SELECT * FROM Istruttore"); 
		while($cicle=mysql_fetch_array($query)){ 
 		echo<<<END
  		<option>$cicle[CodiceFiscale]</option>
END;
		}
		?>
		</select>
		<br />

		Specialit&agrave;:
		<select name="Specialita">
		<?php
		include("connessione_db.php"); 
		$query = mysql_query("SELECT * FROM Specialita"); 
		while($cicle=mysql_fetch_array($query)){ 
 		echo<<<END
  		<option>$cicle[Specialita]</option>
END;
		} 
		?>
		</select>
	
<table align="center">
<tr><td> 
<input type="submit" value="Avanti" /></td>

</form>
<form action="Inserimento.php"  method="POST">
<td><input type="submit" value="Back" /></td>
</tr></table>
</form>
</body>
</html>
<?php
}
?>
