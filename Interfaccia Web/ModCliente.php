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
<h2>Modifica Cliente</h2>

<?php


include("connessione_db.php"); 
$CodiceFiscale=$_POST['CodiceFiscale'];
$query = mysql_query("SELECT * FROM Cliente WHERE CodiceFiscale='$CodiceFiscale'"); 
$cicle=mysql_fetch_array($query);

echo<<<END
<form action="ConfModCliente.php"  method="POST">
  <input type="hidden" name="CodiceFiscale" value="$CodiceFiscale">
  Nome:  <input type="text" name="Nome" value="$cicle[Nome]"><br />
  Cognome: <input type="text" name="Cognome" value="$cicle[Cognome]"><br />
  DataNascita: <input type="date" name="DataNascita" value="$cicle[DataNascita]"><br />
  LuogoNascita: <input type="text" name="LuogoNascita" value="$cicle[LuogoNascita]"><br />
  Indirizzo: <input type="text" name="Indirizzo" value="$cicle[Indirizzo]"><br />
  Sesso: <select name="Sesso">
END;
if ($cicle['Sesso']=='M'){
  echo<<<END
  <option>M</option>   
  <option>F</option>
END;
}
elseif ($cicle['Sesso']=='F'){
  echo<<<END
  <option>F</option>   
  <option>M</option>
END;
  }
else{
  echo<<<END
  <option>$ciclo[Sesso]</option>
  <option>M</option>
  <option>F</option>   
END;
  }   
echo<<<END
   </select>
 <br>
  Telefono: <input type="text" name="Telefono" value="$cicle[Telefono]"><br />
  CodPersonalTrainer: <select name="CodPersonalTrainer">
    <option>$cicle[CodPersonalTrainer]</option>
END;
 $query2=mysql_query("SELECT * FROM PersonalTrainer");
  while($cicle2=mysql_fetch_array($query2)){
    if ($cicle2['CodiceFiscale']!=$cicle['CodPersonalTrainer']){
  echo<<<END
  <option>$cicle2[CodiceFiscale]</option>   
END;
}
}
if($cicle['CodPersonalTrainer']!=''){
  echo<<<END
  <option>NESSUNO</option>
END;
}
echo<<<END
</select>
  <table align="center"><tr><td><input type="submit" value="Modifica" /></td>
</form>
<form action="AggCliente.php" align="left">
       <td><input type="submit" value="Back"/></td></tr></table>
</form>

END;
}
?> 
</body>
</html>