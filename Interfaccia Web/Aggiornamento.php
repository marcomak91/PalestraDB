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
<h1>  Seleziona Tabella <br> Per Effettuare L'Aggiornamento </h1>
<table width="100%" CELLSPACING="50" align="left">
    <tr>
       <td align="center" ><h2><a href="AggPersonale.php">Personale</a></h2></td>
    </tr>
    <tr>
       <td align="center" ><h2><a href="AggCliente.php">Cliente</a></h2></td> 
    </tr>
    <tr>   
       <td align="center" ><h2><a href="AggCorso.php">Corso</a></h2></td>
    </tr>
    <tr>   
       <td align="center" ><h2><a href="AggBadge.php">Badge</a></h2></td>
    </tr>
    <tr>   
       <td align="center" ><h2><a href="AggPrezzoEntrata.php">Prezzo Entrata</a></h2></td>
    </tr>
   <tr>
       <td align="center" ><h2><a href="AggTipoAbbonamento.php">Tipo Abbonamento</a></h2></td>
    </tr>       
   <tr>
       <td align="center" ><h2><a href="AggSegretario.php">Segretario</a></h2></td>    
   </tr>
       <tr><td>
       <form action="HomeAmministrazione.php" align="center">
       <input type="submit" value="Back"/>
       </form></td>
    </tr>

</table>
</body>
</html>

<?
}
?>
