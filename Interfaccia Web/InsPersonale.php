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
<h2>Inserimento Personale</h2>

<form action="RecuperoInsPersonale.php"  method="POST">
  
  CodiceFiscale: <input type="text" name="CodiceFiscale"/><br />
  Nome:  <input type="text" name="Nome"/><br />
  Cognome: <input type="text" name="Cognome"/><br />
  DataNascita: <input type="date" name="DataNascita"/><br />
  LuogoNascita: <input type="text" name="LuogoNascita"/><br />
  Indirizzo: <input type="text" name="Indirizzo"/><br />
  Telefono: <input type="tel" name="Telefono"/><br />
  Stipendio: <input type="float" name="Stipendio"/><br />
  
Sesso:

<select name="Sesso">
    <option>M</option>
    <option>F</option>
</select><br />

Ruolo: 

<select name="Ruolo">
    <option>Istruttore</option>
    <option>PersonalTrainer</option>
    <option>Segretario</option>
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
<?
}
?>
