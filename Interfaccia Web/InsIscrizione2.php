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
<h2>Inserimento Iscrizione Ad Un Corso Di Un Cliente</h2>

<form action="RecuperoInsIscrizione.php" method="POST">

<?php 
$ref = basename($_SERVER['HTTP_REFERER']);

include("connessione_db.php"); 
if ($ref=='InsOccasionale.php?')
{
$CodiceFiscale=$_POST['CodiceFiscale'];
$Nome = $_POST['Nome']; 
$Cognome = $_POST['Cognome'];
$DataNascita=$_POST['DataNascita'];
$LuogoNascita=$_POST['LuogoNascita'];
$Indirizzo=$_POST['Indirizzo'];
$Sesso=$_POST['Sesso'];
$Telefono=$_POST['Telefono'];
$CodPersonalTrainer=$_POST['CodPersonalTrainer'];
$DataOraEntrata=$_POST['DataOraEntrata'];
$Giorno=$_POST['Giorno'];
echo<<<END
<input type="hidden" name="Nome" value="$Nome">
<input type="hidden" name="Cognome" value="$Cognome">
<input type="hidden" name="DataNascita" value="$DataNascita">
<input type="hidden" name="LuogoNascita" value="$LuogoNascita">
<input type="hidden" name="CodiceFiscale" value="$CodiceFiscale">
<input type="hidden" name="Telefono" value="$Telefono">
<input type="hidden" name="Indirizzo" value="$Indirizzo">
<input type="hidden" name="Sesso" value="$Sesso">
<input type="hidden" name="CodPersonalTrainer" value="$CodPersonalTrainer">
<input type="hidden" name="DataOraEntrata" value="$DataOraEntrata">
<input type="hidden" name="Giorno" value="$Giorno">
<input type="hidden" name="link" value="$ref">
END;
?>
Corso :<select name="CodCorso">
<option>NESSUNO</option>;
<?php
$query = mysql_query("SELECT * FROM Corso") ; 
while($cicle=mysql_fetch_array($query)){
echo<<<END
 <option>$cicle[CodCorso]</option>
END;
}
?>
</select>

<?php
}
if ($ref=='InsOccasionaleEsistente.php' or $ref=='InsOccasionaleEsistente.php?')
{
 $CodiceFiscale=$_POST['CodiceFiscale'];
 $query = mysql_query("SELECT * FROM Corso WHERE CodCorso NOT IN(SELECT CodCorso FROM Iscrizione WHERE CodCliente='$CodiceFiscale')") ; 
echo<<<END
Corso :<select name="CodCorso">
<option>NESSUNO</option>;
END;
 while($cicle=mysql_fetch_array($query)){
echo<<<END
 <option>$cicle[CodCorso]</option>
END;
}
echo<<<END
</select>
<input type="hidden" name="link" value="$ref">
<input type="hidden" name="CodCliente" value="$CodiceFiscale">
END;

$DataOraEntrata=$_POST['DataOraEntrata'];
$Giorno=$_POST['Giorno'];
echo<<<END
 <input type="hidden" name="DataOraEntrata" value="$DataOraEntrata">
 <input type="hidden" name="Giorno" value="$Giorno">
END;
} 

if ($ref=='InsIscrizione.php' or $ref=='InsIscrizione.php?')
{
 $CodiceFiscale=$_POST['CodiceFiscale'];
 $query = mysql_query("SELECT * FROM Corso WHERE CodCorso NOT IN(SELECT CodCorso FROM Iscrizione WHERE CodCliente='$CodiceFiscale')") ; 
 echo "Corso: <select name=CodCorso>";
 while($cicle=mysql_fetch_array($query)){
echo<<<END
 <option>$cicle[CodCorso]</option>
END;
}
echo<<<END
</select>
<input type="hidden" name="link" value="$ref">
<input type="hidden" name="CodCliente" value="$CodiceFiscale">
END;
}
?>


<table align="center"><tr>
<td><input type="submit" value="Avanti" /></td>
</form>
<form action="Inserimento.php" align="left">
      <td><input type="submit" value="Back"/></td></tr></table>
</form>
</body>
</html>
<?
}
?>
