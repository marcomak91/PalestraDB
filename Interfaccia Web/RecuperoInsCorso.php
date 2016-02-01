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
if (basename($_SERVER['HTTP_REFERER'])!='ModCorso.php' and basename($_SERVER['HTTP_REFERER'])!='VisCorso.php?')
{
$Giorno = $_POST['Giorno'];
$Tipo = $_POST['Tipo'];
$CodCorso = $_POST['CodCorso'];
$DataInizio = $_POST['DataInizio'];
$DataFine = $_POST['DataFine'];
$PartecipantiMin= $_POST['PartecipantiMin'];
$CodiceFiscale = $_POST['Istruttore'];


$InsCorso=mysql_query("INSERT INTO Corso VALUES ('$CodCorso','$Giorno','$Tipo', '$PartecipantiMin', '$DataInizio', '$DataFine', '$CodiceFiscale')");
if(!$InsCorso) 
die("Inserimento Corso Fallito: " . mysql_error());
}
        echo<<<END
        <h2>Corso Inserito Correttamente<br>Scegli Un' Operazione:</h2>
        <table align="center"><tr>
        <form action="VisCorso.php" align="left">
        <td><input type="submit" value="Visualizza Dati Corso"/></td>
        </form>
        <form action="HomeAmministrazione.php">
        <td><input type="submit" value="Home" /></td></tr></form> 
END;
}

?>
</body>
</html>
                                        						   
