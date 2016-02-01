<?php
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
<h2>Inserimento Cliente Occasionale Gi&agrave; Registrato</h2>

<form action="InsIscrizione2.php"  method="POST">
Cliente
<select name="CodiceFiscale">
<?php 
include("connessione_db.php"); 
 
$query = mysql_query("SELECT CodiceFiscale FROM Cliente WHERE CodiceFiscale NOT IN(SELECT CodiceFiscale FROM Abbonato)"); 
while($cicle=mysql_fetch_array($query)){ 
 echo<<<END
  <option>$cicle[CodiceFiscale]</option>
END;
}
?>
</select><br>
<?php
$DataOraEntrata=date("Y-m-j H:i:s", time());
echo <<< END
DataOraEntrata: <input type="datetime" name="DataOraEntrata" value="$DataOraEntrata"/><br />
Prezzo: <select name="Giorno" />

END;
   
      $query1= mysql_query("SELECT * FROM PrezzoEntrata"); 
      while($cicle=mysql_fetch_array($query1)){    
        echo "<option>".$cicle['Giorno']."</option>";
      }
      ?>
</select>
<Table align="center"><tr><td>
<input type="submit" value="Avanti" /></td>
</form>

<form action="Inserimento.php" align="left">
       <td><input type="submit" value="Back"/></td></tr></table>
</form>
</body>
</html>

<?php 
}
?>
