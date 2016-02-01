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
<h2>Modifica Corso</h2>

<?php
include("connessione_db.php"); 
$CodCorso=$_POST['CodCorso'];
$query = mysql_query("SELECT * FROM Corso WHERE CodCorso='$CodCorso'"); 
$cicle=mysql_fetch_array($query);
echo<<<END
<form action="ConfModCorso.php"  method="POST">
  <input type="hidden" name="CodCorso" value="$CodCorso">
  Giorno:  <select name="Giorno"> 
  <option>$cicle[Giorno]</option>
END;
$Giorno=array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
  for ( $i = 0; $i <7; ++$i)  
   {if   ($Giorno[$i]!=$cicle['Giorno'])
   echo "<option>".$Giorno[$i]."</option>";"<br />";  
   }  
  
echo<<<END
  </select>
  </br>
  Tipo: <select name="Tipo">
  <option>$cicle[Tipo]</option>
END;
 $Tipo =array('Zumba','Fitness','Body Tone','Stretch And Tone','Pilates','Crossing Fit','Yoga','Power Yoga','BioDance','Kung Fu','Tai-Chi','Kick-Boxing','Capoeira' ); 
  for ( $i = 0; $i <13; ++$i)  
   {if   ($Tipo[$i]!=$cicle['Tipo'])
   echo "<option>".$Tipo[$i]."</option>";"<br />";  
   }  
 echo<<<END
</select>
</br>
PartecipantiMinimi: <input type="text" name="PartecipantiMinimi" value="$cicle[PartecipantiMinimi]"><br />
DataInizio: <input type="date" name="DataInizio" value="$cicle[DataInizio]"><br />
DataFine: <input type="date" name="DataFine" value="$cicle[DataFine]"><br />
Codice Istruttore: <select name="CodIstruttore">
<option>$cicle[CodIstruttore]</option><br />
END;
$query2 = mysql_query("SELECT * FROM Istruttore");
 while($cicle2=mysql_fetch_array($query2)){
    if ($cicle2['CodiceFiscale']!=$cicle['CodIstruttore']){
  echo<<<END
  <option>$cicle2[CodiceFiscale]</option>   
END;
}
}
echo<<<END
</select>
</br><table align="center"><tr><td>
<input type="submit" value="Modifica" /></td>
</form>
<form action="AggCorso.php" align="left">
       <td><input type="submit" value="Back"/></td></tr></table>
</form>

END;
}
?> 
</body>
</html>