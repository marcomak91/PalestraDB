<?php
/* attiva la sessione */
session_start();
/* verifica se la variabile ‘login’ e` settata */
$login=$_SESSION['login'];
if (empty($login)) {
 /* non passato per il login: accesso non autorizzato ! */
 echo "Impossibile accedere. Prima effettuare il login.";
} else {
include("connessione_db.php");
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
<h2>Inserimento Cliente Occasionale</h2>


<form action="InsIscrizione2.php"  method="POST">
<?php
   
$DataOraEntrata=date("Y-m-j H:i:s", time());
   echo<<<END
  DataOraEntrata: <input type="datetime" name="DataOraEntrata" value="$DataOraEntrata"  \><br /> 
  
  Prezzo: <select name="Giorno" />

END;
   
      $query= mysql_query("SELECT * FROM PrezzoEntrata"); 
      while($cicle=mysql_fetch_array($query)){    
        echo "<option>".$cicle['Giorno']."</option>";
      }
      ?>
</select>

<br />
<table align="center">
<tr><td><input type="submit" value="Avanti"/></td>
<?php 
 echo<<<END
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
</form>
<form action="InsCliente.php" align="left">
       <td><input type="submit" value="Back"/></td></tr></table>
</form>
</body>
</html>
<?php
}
?>
