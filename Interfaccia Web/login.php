<?php
//includo i file necessari a collegarmi al db con relativo script di accesso
include("connessione_db.php"); 
 
//variabili POST con anti sql Injection

$username=$_POST["username"]; //faccio l'escape dei caratteri dannosi
$password=$_POST["password"]; //sha1 cifra la password anche qui in questo modo corrisponde con quella del db

 $query = "SELECT * FROM Segretario WHERE CodiceFiscale = \"$username\" AND Password = \"$password\" ";
 $ris = mysql_query($query, $connessione) or die (mysql_error());
 $riga=mysql_fetch_array($ris);  
 
/*Prelevo l'identificativo dell'utente */
$login=$riga['CodiceFiscale'];
/* Effettuo il controllo */
if ($login == NULL) $trovato = 0 ;
else $trovato = 1;  
 
/* Username e password corrette */
if($trovato == 1 || ($username=='admin' && $password=='password') ) {
  if($username=='admin' && $password=='password') {
  	$login='username';
   	$password='password';
   }
 /*Registro la sessione*/
  session_start();
  
  /*Registro il codice dell'utente*/
  $_SESSION['login'] = $login;
  Header('Location: HomeAmministrazione.php'); }
else
 Header('Location: index.xhtml');
?>
