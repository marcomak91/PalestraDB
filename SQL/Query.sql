SET FOREIGN_KEY_CHECKS=0;

/*
QUERY
_____________________________________________________________________

1)Corsi che si tengono oggi
*/

SELECT CodCorso, Tipo
FROM Corso
WHERE DAYNAME(CURRENT_DATE())=Giorno AND DataInizio<=CURRENT_DATE() AND DataFine>=CURRENT_DATE()

/*
+-----------+---------------+
| CodCorso  |      Tipo     |
+-----------+---------------+
|           |               |
|           |               |
+-----------+---------------+

_____________________________________________________________________

2)Determinare il numero di clienti seguiti da ogni personal trainer
*/

SELECT p.CodiceFiscale, p.Nome, p.Cognome, COUNT(c.CodiceFiscale) AS ClientiSeguiti
FROM (PersonalTrainer NATURAL JOIN Personale p) LEFT JOIN Cliente c ON p.CodiceFiscale=c.CodPersonalTrainer
GROUP BY p.CodiceFiscale, p.Nome, p.Cognome

/*
+---------------+---------------+---------------+----------------+
| CodiceFiscale |      Nome     |    Cognome    | ClientiSeguiti |
+---------------+---------------+---------------+----------------+
|               |               |               |                |
|               |               |               |                |
+---------------+---------------+---------------+----------------+

_____________________________________________________________________


3)Determinare il numero di abbonati per ogni tipo(durata) di abbonamento
*/

SELECT Durata AS TipoAbbonamento, COUNT(CodAbbonato) AS NumeroAbbonati
FROM Badge NATURAL RIGHT JOIN TipoAbbonamento
GROUP BY Durata

/*
+-----------------+-----------------+
| TipoAbbonamento | NumeroAbbonati  |   
+-----------------+-----------------+
|                 |                 |         
|                 |                 |               
+-----------------+-----------------+

_____________________________________________________________________

4)Spesa totale di ogni occasionale
*/

SELECT CodiceFiscale, Nome, Cognome, SUM(Prezzo) AS SpesaTotale
FROM Cliente NATURAL JOIN Occasionale NATURAL JOIN PrezzoEntrata
GROUP BY CodiceFiscale, Nome, Cognome

/*
+---------------+---------------+---------------+----------------+
| CodiceFiscale |      Nome     |    Cognome    |   SpesaTotale  |
+---------------+---------------+---------------+----------------+
|               |               |               |                |
|               |               |               |                |
+---------------+---------------+---------------+----------------+

_____________________________________________________________________

5)Numero di clienti occasionali, diversi, che entrano nei giorni festivi
*/

SELECT COUNT(DISTINCT CodiceFiscale) AS OccasionaliNeiGiorniFestivi
FROM Occasionale
WHERE Giorno='Festivo'

/*
+-----------------------------+
| OccasionaliNeiGiorniFestivi |      
+-----------------------------+
|                             |              
|                             |               
+-----------------------------+

_____________________________________________________________________

6)Trovare il/i corsi con il maggior numero di partecipanti
*/

SELECT CodCorso, Tipo, COUNT(*) AS NumeroPartecipanti
FROM Iscrizione NATURAL JOIN Corso
GROUP BY CodCorso, Tipo
HAVING COUNT(*)>=ALL(SELECT COUNT(*)
		     FROM Iscrizione NATURAL JOIN Corso
		     GROUP BY CodCorso, Tipo)

/*
+------------+--------------+--------------------+
|  CodCorso  |     Tipo     | NumeroPartecipanti | 
+------------+--------------+--------------------+
|            |              |                    |
|            |              |                    |
+------------+--------------+--------------------+

_____________________________________________________________________

7)Numero di clienti occasionali e data dei giorni in cui sono entrati almeno 5 clienti occasionali, diversi, quest'anno
*/

SELECT COUNT(DISTINCT CodiceFiscale) AS NumeroOccasionali, DATE(DataOraEntrata) AS Data
FROM Occasionale 
WHERE DATE(DataOraEntrata) IN (SELECT DATE(DataOraEntrata)
			       FROM Occasionale
			       WHERE EXTRACT(YEAR FROM DataOraEntrata)=EXTRACT(YEAR FROM CURRENT_DATE())
			       GROUP BY DATE(DataOraEntrata)
			       HAVING COUNT(DISTINCT CodiceFiscale)>5)
GROUP BY DATE(DataOraEntrata)

/*
+-------------------+-------------------+
| NumeroOccasionali |        Data       |    
+-------------------+-------------------+
|                   |                   |              
|                   |                   |              
+-------------------+-------------------+

_____________________________________________________________________

8)Badge che scadono oggi
*/

SELECT CodiceFiscale, Nome, Cognome, Telefono
FROM Abbonato NATURAL JOIN Cliente JOIN Badge ON CodiceFiscale=CodAbbonato
WHERE ScadenzaBadge(CodiceFiscale)=CURRENT_DATE()
ORDER BY CodiceFiscale

/*
+---------------+---------------+---------------+----------------+
| CodiceFiscale |      Nome     |    Cognome    | ClientiSeguiti |
+---------------+---------------+---------------+----------------+
|               |               |               |                |
|               |               |               |                |
+---------------+---------------+---------------+----------------+

_____________________________________________________________________

9)Elimino il/i corsi che inizino oggi e non hanno raggiunto il numero di iscritti sufficiente
*/

DELETE FROM Corso WHERE DataInizio=CURRENT_DATE() AND NumeroIscrittiSuff(CodCorso)=0


/*
_____________________________________________________________________
*/

SET FOREIGN_KEY_CHECKS=1;
