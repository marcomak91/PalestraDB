<?
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
<body>
<h1> Amministrazione </h1>
<h2> Seleziona Un'Operazione </h2>
<table width="100%" CELLSPACING="50" align="center">
    <tr>
       <td align="center" ><h2><a href="Inserimento.php">Inserimento</a></h2></td>
    </tr>
    <tr>
       <td align="center" ><h2><a href="Aggiornamento.php">Aggiornamento</a></h2></td>
    </tr>
    <tr>
       <td align="center" ><h2><a href="Cancellazione.php">Cancellazione</a></h2></td>
    </tr>
    <tr>
       <td align="center" ><h2><a href="Visualizzazione.php">Visualizzazione</a></h2></td>
    </tr>
</table>
</font> 

<h2><a href="logout.php">LogOut</a></h2>
</body>
</html>
<?
}
?>


