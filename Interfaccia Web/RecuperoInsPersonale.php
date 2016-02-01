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
if (basename($_SERVER['HTTP_REFERER'])!='VisIstruttore.php' and basename($_SERVER['HTTP_REFERER'])!='VisPersonalTrainer.php')
{
$CodiceFiscale = $_POST['CodiceFiscale'];
$Nome = $_POST['Nome'];
$Cognome = $_POST['Cognome'];
$DataNascita = $_POST['DataNascita'];
$LuogoNascita= $_POST['LuogoNascita'];
$Indirizzo = $_POST['Indirizzo'];
$Sesso = $_POST['Sesso'];
$Telefono = $_POST['Telefono'];
$Stipendio = $_POST['Stipendio'];
$Ruolo= $_POST['Ruolo'];

$InsPersonale=mysql_query("INSERT INTO Personale(CodiceFiscale, Nome, Cognome, DataNascita, LuogoNascita, Indirizzo, Sesso, Telefono, Stipendio) VALUES 
                           ('$CodiceFiscale','$Nome','$Cognome','$DataNascita','$LuogoNascita','$Indirizzo','$Sesso','$Telefono','$Stipendio')");
}						  
    if (basename($_SERVER['HTTP_REFERER'])!='VisIstruttore.php' and basename($_SERVER['HTTP_REFERER'])!='VisPersonalTrainer.php')
    {				   
     if (!$InsPersonale) 
       die("Insermiento Personale Fallito:" . mysql_error());
     else
     { 		
      if ($Ruolo=='PersonalTrainer')
	       {$InsPersonalTrainer= mysql_query("INSERT INTO PersonalTrainer VALUES ('$CodiceFiscale')");
          if (!$InsPersonalTrainer)
            {$EliPersonale=mysql_query("DELETE FROM Personale WHERE CodiceFiscale=$CodiceFiscale");
            die("Inserimento Personal Trainer Fallito: " . mysql_error()); }
          else 
            {
              echo<<<END
              <h2>Personal Trainer Inserito Correttamente<br>Scegli Un' Operazione:</h2>
              <form action="VisPersonalTrainer.php"> 
              <table align="center"><tr><td>
              <input type="submit" value="Visualizza Dati Personal Trainer" /></td>
              </form>
              <form action="HomeAmministrazione.php">
              <td><input type="submit" value="Home" /></td></tr></table>
              </form> 
END;
}}
     if ($Ruolo=='Segretario') {
        echo<<<END
          <form action="RecuperoInsSegretario.php"  method="POST">

            Scegli Password:  <input type="password" name="Password"/>

            <input type="hidden" name="CodiceFiscale" value="$CodiceFiscale">


            <input type="submit" value="Avanti" /></td>
          </form>
END;
        
         }

    if ($Ruolo=='Istruttore') 
       {$InsIstruttore= mysql_query("INSERT INTO Istruttore VALUES ('$CodiceFiscale')");
        if (!$InsIstruttore)
         {$EliPersonale=mysql_query("DELETE FROM Personale WHERE CodiceFiscale=$CodiceFiscale");
          die("Inseriento Istruttore Fallito: " . mysql_error());}
        else    
       {
       echo<<<END
       <h2>Istruttore Inserito Correttamente<br>Scegli Un' Operazione:</h2>
       <form action="VisPersonale.php" > 
       <table align="center"><tr><td>
       <input type="submit" value="Visualizza Dati Personale" /></td>
       </form> 
       <form action="HomeAmministrazione.php">
       <td><input type="submit" value="Home" /></td></tr></table>
       </form> 
END;
}}}}
}
?>
</body>
</html>