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
if (basename($_SERVER['HTTP_REFERER'])=='RecuperoInsPersonale.php') {
$CodiceFiscale = $_POST['CodiceFiscale'];
$Password=$_POST['Password'];
    
$InsSegretario= mysql_query("INSERT INTO Segretario VALUES ('$CodiceFiscale', '$Password')");
        if (!$InsSegretario)
         {$EliPersonale=mysql_query("DELETE FROM Personale WHERE CodiceFiscale=$CodiceFiscale");
          die("Inseriento Segretario Fallito: " . mysql_error());}
        else    
       {
       echo<<<END
      <h2>Segretario Inserimento Correttamente<br>Scegli Un' Operazione:</h2>
       <form action="VisSegretario.php" > 
       <table align="center"><tr><td>
       <input type="submit" value="Visualizza Dati Segretario" /></td>
       </form> 
       <form action="HomeAmministrazione.php" >
       <td><input type="submit" value="Home" /></td></tr></table>
       </form> 
END;
}
}
}
?>
</body>
</html>