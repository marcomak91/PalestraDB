<?php
/* attiva la sessione */
session_start();
/* verifica se la variabile ‘login’ e` settata */
$login=$_SESSION['login'];
if (empty($login)) {
 /* non passato per il login: accesso non autorizzato ! */
 echo "Impossibile accedere. Prima effettuare il login.";
} else {
$CodiceFiscale=$_SESSION['CodiceFiscale'];
$Nome = $_SESSION['Nome']; 
$Cognome = $_SESSION['Cognome'];
$DataNascita=$_SESSION['DataNascita'];
$LuogoNascita=$_SESSION['LuogoNascita'];
$Indirizzo=$_SESSION['Indirizzo'];
$Sesso=$_SESSION['Sesso'];
$Telefono=$_SESSION['Telefono'];
$CodPersonalTrainer=$_SESSION['CodPersonalTrainer'];
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
<h2>Inserimento Cliente Abbonato</h2>
<form action="RecuperoInsAbbonato.php"  method="POST">

  Tipo Abbonamento: <select name="Durata">
 <?php  
  include("connessione_db.php");
  $query = mysql_query("SELECT * FROM TipoAbbonamento");
  while($cicle=mysql_fetch_array($query)){
  echo<<<END
  <option>$cicle[Durata]</option>   
END;
}
echo<<<END
</select>

<input type="hidden" name="CodiceFiscale" value="$CodiceFiscale">
<input type="hidden" name="Nome" value="$Nome">
<input type="hidden" name="Cognome" value="$Cognome">
<input type="hidden" name="DataNascita" value="$DataNascita">
<input type="hidden" name="LuogoNascita" value="$LuogoNascita">
<input type="hidden" name="Indirizzo" value="$Indirizzo">
<input type="hidden" name="Sesso" value="$Sesso">
<input type="hidden" name="Telefono" value="$Telefono">
<input type="hidden" name="CodPersonalTrainer" value="$CodPersonalTrainer">
END;

?> 
</select>
<table align="center"><tr><td>
<input type="submit" value="Avanti"/>
</td>
</form>

 <form action=InsCliente.php >
<td><input type="submit" value="Back"/></td></tr></table>
</form>
</body>
</html>
<?php
}
?>
