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
if (basename($_SERVER['HTTP_REFERER'])!='VisAbbonato.php' and basename($_SERVER['HTTP_REFERER'])!='ModCliente.php' )
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
$Durata=$_POST['Durata'];
 
if($CodPersonalTrainer=='NESSUNO'){
$InsCliente=mysql_query("INSERT INTO Cliente(CodiceFiscale, Nome,Cognome,DataNascita,LuogoNascita,Indirizzo,Sesso,Telefono,CodPersonalTrainer) VALUES 
                           ('$CodiceFiscale','$Nome','$Cognome','$DataNascita','$LuogoNascita','$Indirizzo','$Sesso','$Telefono', NULL)");
}
else{
  $InsCliente=mysql_query("INSERT INTO Cliente(CodiceFiscale, Nome,Cognome,DataNascita,LuogoNascita,Indirizzo,Sesso,Telefono,CodPersonalTrainer) VALUES 
                           ('$CodiceFiscale','$Nome','$Cognome','$DataNascita','$LuogoNascita','$Indirizzo','$Sesso','$Telefono','$CodPersonalTrainer')");
}          
 
    if (!$InsCliente) 
       die("Inserimento Cliente Fallito :" . mysql_error());
    else{ 	
    $InsAbbonato=mysql_query("INSERT INTO Abbonato(CodiceFiscale) VALUES ('$CodiceFiscale')");	
      			 
    if (!$InsAbbonato)
      {
      {$EliCliente=mysql_query("DELETE FROM Cliente WHERE CodiceFiscale=$CodiceFiscale ");
       die("Inserimento Abbonato Fallito :" . mysql_error());
      }
    }
    $InsBadge=mysql_query("INSERT INTO Badge(CodAbbonato, DataInizio, Durata) VALUES ('$CodiceFiscale', current_date(), '$Durata')"); 
    if (!$InsBadge) 
       die("Inserimento Badge Fallito :" . mysql_error());
  }}
    
echo<<<END
    <h2>Inserimento Abbonato Avvenuto<br>Scegli Un' Operazione:</h2>
      <table align="center"><tr>
      <form action="VisAbbonato.php"><td>
      <input type="submit" value="Visualizza Dati Abbonato" /></td>
      </form><form action="HomeAmministrazione.php"><td>
      <input type="submit" value="Home" /></td></tr></form>    
END;

}
?>
</body>
</html>
						   
