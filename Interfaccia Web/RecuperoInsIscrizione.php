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
} 
else {

  include("connessione_db.php"); 

  if (basename($_SERVER['HTTP_REFERER'])!='VisCliente.php?' and basename($_SERVER['HTTP_REFERER'])!='VisIscrizione.php?' and basename($_SERVER['HTTP_REFERER'])!='VisOccasionale.php?')
  { 
    $CodCorso=$_POST['CodCorso'];
    $link=$_POST['link'];
    if ($link=='InsOccasionale.php?')
    {
     $CodiceFiscale=$_SESSION['CodiceFiscale'];
     $Nome = $_SESSION['Nome']; 
     $Cognome = $_SESSION['Cognome'];
     $DataNascita=$_SESSION['DataNascita'];
     $LuogoNascita=$_SESSION['LuogoNascita'];
     $Indirizzo=$_SESSION['Indirizzo'];
     $Sesso=$_SESSION['Sesso'];
     $Telefono=$_SESSION['Telefono'];
     $CodPersonalTrainer=$_SESSION['CodPersonalTrainer'];

     if($CodPersonalTrainer=='NESSUNO'){
     $InsCliente=mysql_query("INSERT INTO Cliente(CodiceFiscale, Nome,Cognome,DataNascita,LuogoNascita,Indirizzo,Sesso,Telefono,CodPersonalTrainer) VALUES 
                           ('$CodiceFiscale','$Nome','$Cognome','$DataNascita','$LuogoNascita','$Indirizzo','$Sesso','$Telefono', NULL)");
     }
     else{
       $InsCliente=mysql_query("INSERT INTO Cliente(CodiceFiscale, Nome,Cognome,DataNascita,LuogoNascita,Indirizzo,Sesso,Telefono,CodPersonalTrainer) VALUES 
                           ('$CodiceFiscale','$Nome','$Cognome','$DataNascita','$LuogoNascita','$Indirizzo','$Sesso','$Telefono','$CodPersonalTrainer')");
      }  
      if (!$InsCliente)
        die('Inserimento Cliente Fallito:' .mysql_error());
      $DataOraEntrata=$_POST['DataOraEntrata'];
      $Giorno=$_POST['Giorno']; 
      $InsOccasionale=mysql_query("INSERT INTO Occasionale(CodiceFiscale, DataOraEntrata, Giorno) VALUES 
                           ('$CodiceFiscale' ,'$DataOraEntrata','$Giorno')");
      if (!$InsOccasionale)
      {
        $Elicliente=mysql_query("DELETE FROM Cliente WHERE CodiceFiscale='$CodiceFiscale'");
        die('Inserimento Occasionale Fallito:' .mysql_error());
      }
  
      if($CodCorso!='NESSUNO') 
      { //se occasionale fa solo attività palestra e non corsi, non serve salvare nulla in più
        $InsIscrizione=mysql_query("INSERT INTO Iscrizione (CodCliente, CodCorso) VALUES ('$CodiceFiscale', '$CodCorso')");
        if (!$InsIscrizione)
        {
          $Elicliente=mysql_query("DELETE FROM Cliente WHERE CodiceFiscale='$CodiceFiscale'");
          die('Inserimento Iscrizione Fallito:' .mysql_error());
        }
      else
      {     
        echo<<<END
        <h2>Inserimento Avvenuto Correttamente<br>Scegli Un' Operazione:</h2>
        <table align="center"><tr>
        <form action="VisCliente.php">
        <td><input type="submit" value="Visualizza Dati Cliente" /></td>
        </form> 
        <form action="VisOccasionale.php">
        <td><input type="submit" value="Visualizza Dati Occasionale" /></td>
        </form> 
        <form action="VisIscrizione.php">
        <td><input type="submit" value="Visualizza Dati Iscrizione" /></td>
        </form> 
        <form action="HomeAmministrazione.php">
        <td><input type="submit" value="Home" /></td></tr></table>
        </form>   
END;
      }
    }
    else
      {     
        echo<<<END
        <h2>Inserimento Avvenuto Correttamente<br>Scegli Un' Operazione:</h2>
        <table align="center"><tr>
        <form action="VisCliente.php">
        <td><input type="submit" value="Visualizza Dati Cliente" /></td>
        </form> 
        <form action="VisOccasionale.php">
        <td><input type="submit" value="Visualizza Dati Occasionale" /></td>
        </form> 
        <form action="HomeAmministrazione.php">
        <td><input type="submit" value="Home" /></td></tr></table>
        </form>   
END;
      }
    }

    if ($link=='InsOccasionaleEsistente.php' or $link=='InsOccasionaleEsistente.php?')
    {
      $CodiceFiscale=$_POST['CodCliente'];
      $DataOraEntrata=$_POST['DataOraEntrata'];
      $Giorno=$_POST['Giorno']; 
      $InsOccasionale=mysql_query("INSERT INTO Occasionale(CodiceFiscale, DataOraEntrata, Giorno) VALUES 
                           ('$CodiceFiscale' ,'$DataOraEntrata','$Giorno')");
      if (!$InsOccasionale)
      {
        die('Inserimento Occasionale Fallito:' .mysql_error());
      }
  
      if($CodCorso!='NESSUNO') 
      {//se occasionale fa solo attività palestra e non corsi, non serve salvare nulla in più
        $InsIscrizione=mysql_query("INSERT INTO Iscrizione VALUES ('$CodiceFiscale', '$CodCorso')");
        if (!$InsIscrizione)
        {
          die('Inserimento Iscrizione Fallito:' .mysql_error());
        }
        else
        {
          echo<<<END
          <h2>Inserimento Avvenuto Correttamente<br>Scegli Un' Operazione:</h2>
          <table align="center"><tr>
          <form action="VisOccasionale.php">
          <td><input type="submit" value="Visualizza Dati Occasionale" /></td>
          </form> 
          <form action="VisIscrizione.php">
          <td><input type="submit" value="Visualizza Dati Iscrizione" /></td>
          </form> 
          <form action="HomeAmministrazione.php">
          <td><input type="submit" value="Home" /></td></tr></table>
          </form>   
END;
        } 
      }
      else
      {     
        echo<<<END
        <h2>Inserimento Avvenuto Correttamente<br>Scegli Un' Operazione:</h2>
        <table align="center"><tr>
        <form action="VisOccasionale.php">
        <td><input type="submit" value="Visualizza Dati Occasionale" /></td>
        </form> 
        <form action="HomeAmministrazione.php">
        <td><input type="submit" value="Home" /></td></tr></table>
        </form>   
END;
      }
    }
 
    if ($link=='InsIscrizione.php' or $link=='InsIscrizione.php?')
    {
      $CodiceFiscale=$_POST['CodCliente'];
      $InsIscrizione = mysql_query("INSERT INTO Iscrizione VALUES 
                           ('$CodiceFiscale','$CodCorso')");
      if (!$InsIscrizione)
        {
          die('Inserimento Iscrizione Fallito:' .mysql_error());
        }
      echo<<<END
      <h2>Inserimento Avvenuto Correttamente<br>Scegli Un' Operazione:</h2>
      <table align="center"><tr>
      <form action="VisIscrizione.php">
      <td><input type="submit" value="Visualizza Dati Iscrizione" /></td>
      </form>   
      <form action="HomeAmministrazione.php">
      <td><input type="submit" value="Home" /></td></tr></table>
      </form>   
END;
    }

  }
} 
?>
</body>
</html>