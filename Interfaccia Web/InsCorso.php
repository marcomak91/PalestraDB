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
<h2>Inserimento Corso</h2>


<form action="RecuperoInsCorso.php"  method="POST">
Tipo:
<select name="Tipo">
    <option>Zumba</option>
    <option>Fitness</option>
    <option>Body Tone</option>
    <option>Stretch And Tone</option>
    <option>Pilates</option>
    <option>Crossing Fit</option>
    <option>Yoga</option>
    <option>Power Yoga</option>
    <option>BioDance</option>
    <option>Kung Fu</option>
    <option>Tai-Chi</option>
    <option>Kick-Boxing</option>
    <option>Capoeira</option>
</select>
<br />
Giorno:
<select name="Giorno">
    <option>Monday</option>
    <option>Tuesday</option>
    <option>Wednesday</option>
    <option>Thursday</option>
    <option>Friday</option>
    <option>Saturday</option>
    <option>Sunday</option>
</select>
<br />
    CodiceCorso: <input type="text" name="CodCorso"/><br />
    DataInizio: <input type="date" name="DataInizio"/><br />
    DataFine: <input type="date" name="DataFine"/><br />
    Partecpiantiminimi:  <input type="text" name="PartecipantiMin"/><br />
  
  Istruttore: <select name="Istruttore">
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
<table align="center"><tr><td>
<input type="submit" value="Avanti" /></td>
</form>

<form action="Inserimento.php" align="left">
       <td><input type="submit" value="Back"/></td></tr></table>
</form>
</body>
</html>

<?
}
?>

