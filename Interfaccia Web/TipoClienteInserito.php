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

$_SESSION['CodiceFiscale']=$_REQUEST['CodiceFiscale'];
$_SESSION['Nome']=$_REQUEST['Nome'];
$_SESSION['Cognome']=$_REQUEST['Cognome'];
$_SESSION['DataNascita']=$_REQUEST['DataNascita'];
$_SESSION['LuogoNascita']=$_REQUEST['LuogoNascita'];
$_SESSION['Indirizzo']=$_REQUEST['Indirizzo'];
$_SESSION['Sesso']=$_REQUEST['Sesso'];
$_SESSION['Telefono']=$_REQUEST['Telefono'];
$_SESSION['CodPersonalTrainer']=$_REQUEST['CodPersonalTrainer'];

$Cliente=$_REQUEST['Cliente'];


if($Cliente=='Abbonato'){
	header("Location:InsAbbonato.php?");}

if($Cliente=='Occasionale'){
	header("Location:InsOccasionale.php?");}

echo<<<END

END;
}
?>
</body>
</html>