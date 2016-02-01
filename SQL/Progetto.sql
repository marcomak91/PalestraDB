SET FOREIGN_KEY_CHECKS=0;

/*
Caricamento Tabelle
________________________________________________________________
*/

USE Progetto;                                             


DROP TABLE IF EXISTS Personale;
DROP TABLE IF EXISTS Segretario;
DROP TABLE IF EXISTS Istruttore;
DROP TABLE IF EXISTS Specialita;
DROP TABLE IF EXISTS Specializzazione;
DROP TABLE IF EXISTS PersonalTrainer;
DROP TABLE IF EXISTS Corso;
DROP TABLE IF EXISTS Cliente;
DROP TABLE IF EXISTS Iscrizione;
DROP TABLE IF EXISTS Abbonato;
DROP TABLE IF EXISTS PrezzoEntrata;
DROP TABLE IF EXISTS Occasionale;
DROP TABLE IF EXISTS TipoAbbonamento;
DROP TABLE IF EXISTS Badge; 


CREATE TABLE Personale (                               
      CodiceFiscale  CHAR(16)  PRIMARY KEY,
      Nome           CHAR(15)  NOT NULL,
      Cognome        CHAR(15)  NOT NULL,
      DataNascita    DATE,
      LuogoNascita   CHAR(20),
      Indirizzo      CHAR(30),
      Sesso          ENUM('M','F'),  
      Telefono       INT(11),
      Stipendio      FLOAT(8)
      ) ENGINE=InnoDB;
       
CREATE TABLE Segretario (
      CodiceFiscale  CHAR(16)  PRIMARY KEY,    
      Password       CHAR(15)  NOT NULL,
      FOREIGN KEY (CodiceFiscale) REFERENCES Personale(CodiceFiscale)
                                       ON DELETE CASCADE
                                       ON UPDATE CASCADE
      ) ENGINE=InnoDB;
       
CREATE TABLE PersonalTrainer (
      CodiceFiscale          CHAR(16)  PRIMARY KEY,
      FOREIGN KEY (CodiceFiscale) REFERENCES Personale(CodiceFiscale)
                                        ON DELETE CASCADE
                                        ON UPDATE CASCADE
      ) ENGINE=InnoDB;   

CREATE TABLE Istruttore (
      CodiceFiscale          CHAR(16)  PRIMARY KEY,
      FOREIGN KEY (CodiceFiscale) REFERENCES Personale(CodiceFiscale)
                                        ON DELETE CASCADE
                                        ON UPDATE CASCADE
      ) ENGINE=InnoDB;  

CREATE TABLE Specialita (
      Specialita             CHAR(25) PRIMARY KEY
      ) ENGINE=InnoDB; 

CREATE TABLE Specializzazione (
      CodIstruttore          CHAR(16),
      Specialita             CHAR(25),
      PRIMARY KEY(CodIstruttore, Specialita),
      FOREIGN KEY (CodIstruttore) REFERENCES Istruttore(CodiceFiscale)
				       ON DELETE CASCADE
                                       ON UPDATE CASCADE,
      FOREIGN KEY (Specialita) REFERENCES Specialita(Specialita)
				       ON DELETE CASCADE
                                       ON UPDATE CASCADE
      ) ENGINE=InnoDB; 

CREATE TABLE Corso (					
      CodCorso               CHAR(28) PRIMARY KEY,
      Giorno                 ENUM('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') COLLATE utf8_general_ci NOT NULL,
      Tipo                   CHAR(25) NOT NULL,
      PartecipantiMinimi     INT(3) NOT NULL,
      DataInizio	     DATE NOT NULL,
      DataFine		     DATE NOT NULL,
      CodIstruttore          CHAR(16),         
      FOREIGN KEY(CodIstruttore) REFERENCES Istruttore(CodiceFiscale)
				       ON DELETE SET NULL 
                                       ON UPDATE CASCADE
      ) ENGINE=InnoDB;

CREATE TABLE Cliente (
      CodiceFiscale          CHAR(16)  PRIMARY KEY,
      Nome                   CHAR(15)  NOT NULL,
      Cognome                CHAR(15)  NOT NULL,
      DataNascita            DATE,
      LuogoNascita           CHAR(20),
      Indirizzo              CHAR(30),
      Sesso                  ENUM('M','F'),
      Telefono               INT(11),
      CodPersonalTrainer     CHAR(16), 
      FOREIGN KEY(CodPersonalTrainer) REFERENCES PersonalTrainer(CodiceFiscale)
				       ON DELETE SET NULL
                                       ON UPDATE CASCADE
      ) ENGINE=InnoDB;

CREATE TABLE Iscrizione (
      CodCliente             CHAR(16),
      CodCorso               CHAR(28),
      PRIMARY KEY (CodCliente, CodCorso),
      FOREIGN KEY (CodCliente) REFERENCES Cliente(CodiceFiscale)
				       ON DELETE CASCADE
                                       ON UPDATE CASCADE,
      FOREIGN KEY (CodCorso) REFERENCES Corso(CodCorso) 
				       ON DELETE CASCADE
                                       ON UPDATE CASCADE 
      ) ENGINE=InnoDB;

CREATE TABLE Abbonato (
      CodiceFiscale          CHAR(16)   PRIMARY KEY,
      FOREIGN KEY (CodiceFiscale) REFERENCES Cliente(CodiceFiscale)
                                          ON DELETE CASCADE
                                          ON UPDATE CASCADE
      ) ENGINE=InnoDB;

CREATE TABLE PrezzoEntrata (
      Giorno                 ENUM('Feriale','Festivo') PRIMARY KEY,
      Prezzo                 FLOAT(8) NOT NULL
      ) ENGINE=InnoDB;

CREATE TABLE Occasionale (
      CodiceFiscale          CHAR(16),
      DataOraEntrata         DATETIME,  
      Giorno                 ENUM('Feriale','Festivo') NOT NULL,
      PRIMARY KEY(CodiceFiscale, DataOraEntrata),
      FOREIGN KEY (CodiceFiscale) REFERENCES Cliente(CodiceFiscale)
                                          ON DELETE CASCADE
                                          ON UPDATE CASCADE,
      FOREIGN KEY (Giorno) REFERENCES PrezzoEntrata(Giorno)
                                      	  ON DELETE NO ACTION 
                                      	  ON UPDATE NO ACTION 
      ) ENGINE=InnoDB;

CREATE TABLE TipoAbbonamento (
      Durata                 ENUM('Mensile', 'Trimestrale', 'Semestrale','Annuale')   PRIMARY KEY,
      Prezzo                 FLOAT(8)   NOT NULL
      ) ENGINE=InnoDB;

CREATE TABLE Badge ( 
      CodAbbonato	     CHAR(16) PRIMARY KEY,
      DataInizio             DATE NOT NULL,
      Durata                 ENUM('Mensile', 'Trimestrale', 'Semestrale','Annuale') NOT NULL,
      FOREIGN KEY (CodAbbonato) REFERENCES Abbonato(CodiceFiscale)
                                          ON DELETE CASCADE
                                          ON UPDATE CASCADE,
      FOREIGN KEY (Durata) REFERENCES TipoAbbonamento(Durata)
                                      	  ON DELETE NO ACTION  
                                      	  ON UPDATE NO ACTION  
      ) ENGINE=InnoDB;


/*
Popolamento
________________________________________________________________
*/

INSERT INTO `TipoAbbonamento` (`Durata`, `Prezzo`) VALUES
('Mensile', 45),
('Trimestrale', 120),
('Semestrale', 230),
('Annuale', 400);

INSERT INTO `Specialita` (`Specialita`) VALUES
('Body Tone'),
('Fitness'),
('Zumba'),
('Stretch And Tone'),
('Pilates'),
('Crossing Fit'),
('Yoga'),
('Power Yoga'),
('BioDance'),
('Kung Fu'),
('Tai-Chi'),
('Kick-Boxing'),
('Capoeira');

INSERT INTO `PrezzoEntrata` (`Giorno`, `Prezzo`) VALUES
('Feriale', 8.00),
('Festivo', 10.00);

INSERT INTO `Personale` (`CodiceFiscale`, `Nome`, `Cognome`, `DataNascita`, `LuogoNascita`, `Indirizzo`, `Sesso`, `Telefono`, `Stipendio`) VALUES
('MNRMHL93D15A757H', 'Michael', 'Munaro', '1993-04-15', 'Belluno', 'via 27 aprile 3/a', 'M', '0437454564', 4000),
('ZZRMRC74D12G224E', 'Marco', 'Azzurri', '1984-04-12', 'Padova', 'Via Roma 34','M', '0499729800', 1300),
('BRNMHL87A20A757Q', 'Michael', 'Bernardi', '1987-01-20', 'Belluno', 'Via Boschi 69','M', '0437978486', 1400),
('MRSMRC89E11L736X', 'Marco', 'Morassutti', '1989-05-11', 'Venezia', 'Via Dei Numeri 111','M', '0418715801', 1400),
('CSTNTN90L23H620G', 'Antonio', 'Cesto', '1990-07-23', 'Rovigo', 'Via Montello 24','M', '0425729876', 1600),
('RSSVEA87D52G224D', 'Eva', 'Rossi', '1987-04-12', 'Padova', 'Via Verdi 14','F',  '0493549350', 1300),
('BLLMCL70B25L840G', 'Marcello', 'Bello', '1970-02-25', 'Vicenza', 'Via Monte Bianco  72','M',  '0444972980', 1800),
('LSTRST64C30L736C', 'Ernesto', 'Lesto', '1964-03-30', 'Venezia', 'Via Dei Re 64','M', '0414429860', 1900),
('ZRERNN87P62A757W', 'Rossana', 'Zero', '1987-09-22', 'Belluno', 'Via Dei Remagi 114','F', '0437729867', 1400),
('FNTFRC84E62L407F', 'Federica', 'Fontana', '1984-05-22', 'Treviso', 'Via Luzzatti 24','F', '0422978970', 1400),
('MLLSML84D12G224I', 'Samuele', 'Melli', '1984-04-12', 'Padova', 'Via Adige 99','M',  '0499729564', 1500),
('CNTFLC78B10G224O', 'Felice', 'Centofanti', '1978-02-10', 'Padova', 'Via Dei Mille 78','M', '0499745667', 1800),
('MRNGLR79D52L736P', 'Gloria', 'Morandin', '1979-04-12', 'Venezia', 'Via Treviso 15','F', '0415526780', 1700),
('PTOCRL78M42L406L', 'Carla', 'Pota', '1978-08-02', 'Treviso', 'Via Burchiellati 7','F', '0442972671', 1700);

INSERT INTO `Istruttore` (`CodiceFiscale`) VALUES
('MRSMRC89E11L736X'),
('ZRERNN87P62A757W'),
('CNTFLC78B10G224O'),
('MRNGLR79D52L736P'),
('PTOCRL78M42L406L'),
('LSTRST64C30L736C'),
('ZZRMRC74D12G224E');

INSERT INTO `PersonalTrainer` (`CodiceFiscale`) VALUES
('BRNMHL87A20A757Q'),
('CSTNTN90L23H620G'),
('RSSVEA87D52G224D'),
('BLLMCL70B25L840G'),
('FNTFRC84E62L407F'),
('MNRMHL93D15A757H'),
('MLLSML84D12G224I');

INSERT INTO `Segretario` (`CodiceFiscale`, `Password`) VALUES
('MNRMHL93D15A757H', 'ambdere');

INSERT INTO `Cliente` (`CodiceFiscale`, `Nome`, `Cognome`, `DataNascita`, `LuogoNascita`, `Indirizzo`, `Sesso`, `Telefono`, `CodPersonalTrainer`) VALUES
('BRTFRN82R17D34FR', 'Franco', 'Bertone', '1982-12-17', 'Venezia', 'via Quasimodo 6', 'M', '34257783291', 'BLLMCL70B25L840G'),
('FRRALB91O18M8HVB', 'Alberto', 'Ferrari', '1991-05-18', 'Ravenna', 'via TalDeiTali 21', 'M', '34823248945', NULL),
('MNRDGO64Q03N88HU', 'Diego', 'Munaro', '1964-11-03', 'Chies Alpago', 'via Dante 41', 'M', '34745378933', NULL),
('PDVTZN88G18A7J87', 'Tiziano', 'Padovan', '1988-04-18', 'Munich', 'via Giacomo Matteotti 47', 'M', '33485743278', 'MLLSML84D12G224I'),
('PRCCRL96G17A658U', 'Carla', 'Parcianello', '1996-08-17', 'Vittorio Veneto', 'via Piazzale Vittoria', 'F', '33414334875', 'CSTNTN90L23H620G'),
('RCCELN96G31A345R', 'Elena', 'Ricci', '1996-07-31', 'Montevideo', 'viale al lago 10', 'F', '3482346926', NULL),
('RSSMRI72E13G982S', 'Mario', 'Rossi', '1972-01-13', 'Milano', 'via Duomo 8', 'M', '34512345678', 'MNRMHL93D15A757H'),
('SPNCRL96F08N767J', 'Carlotta', 'Spinazze', '1996-10-08', 'Belluno', 'via Villaggio Riviera 9', 'F', '34724859433', 'MNRMHL93D15A757H'),
('TLTANN00K28L9IJU', 'Anna', 'Tollot', '2000-07-28', 'Padova', 'via Riviera 4', 'F', '33489776435', NULL),
('TLTPTR93W27F757H', 'Pietro', 'Tollot', '1993-02-27', 'Belluno', 'via 27 aprile', 'M', '34711847890', NULL),
('BRSPLA85S02L736F', 'Paolo', 'Brosio', '1985-11-02', 'Venezia', 'via Casuale 2', 'M', '34512768789', 'BRNMHL87A20A757Q'),
('BSSFNC93A11L407Q', 'Franco', 'Basso', '1993-01-11', 'Treviso', 'via Vittoria 75','M', '45398874364',NULL),
('PGGMNL89E12G224C', 'Manuel', 'Poggiali', '1989-12-05', 'Padova', 'viale Roventa 34','M', '34723435678', 'RSSVEA87D52G224D'),
('MGGVNZ84E07L407J', 'Vincenzo', 'Maggio', '1984-05-07', 'Treviso', 'via Basso 9','M', '34627783342', 'BLLMCL70B25L840G'),
('LSBCLS89C70L407U', 'Elisabetta', 'Canalis', '1989-03-30', 'Treviso', 'via del tutto eccezionale','F', '34634544307', 'FNTFRC84E62L407F'),
('PPRGLC77R24G224Z', 'Gianluca', 'Paparesta', '1977-10-24', 'Padova', 'via Polenta 28','M', '33874300934', 'MLLSML84D12G224I'),
('CGNLEI89T02G224Y', 'Elia', 'Cagnin', '1989-12-02', 'Padova', 'via Osei 56','M', '33467988098',NULL), 
('PPESMN87R01L736A', 'Simone', 'Pepe', '1987-01-10', 'Venezia', 'via Tale 7','M', '34037654109',NULL),
('LNGGLC97A17L736H', 'Gianluca', 'Longo', '1997-01-17', 'Venezia', 'viale Magenta 32','M', '33465789022', 'BLLMCL70B25L840G'),
('SMNGPP83D12G224V', 'Giuseppe', 'Simone', '1983-04-12', 'Padova', 'via Viosa 3','M', '34523890094', 'FNTFRC84E62L407F'),
('NNZMTN89A19F839M', 'Martino', 'Nunziata', '1989-01-19', 'Napoli', 'via Banana 7','M', '34829904893', NULL),
('FTOMRN80E57L840F', 'Morena', 'Foti', '1980-05-17', 'Vicenza', 'via Rossa 13','F', '34066789089','BRNMHL87A20A757Q'),
('MCNMLN96R56G224Q', 'Milena', 'Miconi', '1996-10-16', 'Padova', 'via Blu 8','F', '33412984932',NULL),
('RSOGLI95C53A757H', 'Giulia', 'Rosi', '1995-03-13', 'Belluno', 'via Gialla 9','F', '39856733098', 'CSTNTN90L23H620G'),
('PSCMRT97E62G224F', 'Marta', 'Pesce', '1997-05-22', 'Padova', 'via Bilita','F', '49433323409', 'MLLSML84D12G224I'),
('BFOLVI87R52L840U', 'Livia', 'Bof', '1987-10-12', 'Vicenza', 'viale Europa 88','F', '33198734589', 'RSSVEA87D52G224D'),
('PSCMRC90C26L407Y', 'Marco', 'Pesce', '1990-03-26', 'Treviso', 'via Burkina 20','M', '34587655748', 'BRNMHL87A20A757Q'),
('STRMRA73D55L736U', 'Maria', 'Stuarda', '1973-04-15', 'Venezia', 'via Verdi 56','F', '12345678900',NULL),
('FVRMTN77L59L736Z', 'Martina', 'Favaro', '1977-07-19', 'Venezia', 'via Raimondo 37' ,'F', '34213234908', 'MNRMHL93D15A757H'),
('FRSPNLRT92A10G4G', 'Alberto', 'Franceschi', '1992-01-10', 'Padova', 'via Quasimodo','M', '33823229870', 'BLLMCL70B25L840G'),
('SMMGRG50C12G224E', 'Giorgio', 'Summiti', '1950-03-12', 'Padova', 'via Punto 9','M', '39809832890', NULL),
('SMMMRC70E19G224E', 'Marco', 'Summiti', '1970-05-19', 'Padova', 'via Essere 78','M', '45388920342', NULL),
('RDNFNC87A17L736T', 'Franco', 'Ordine', '1987-01-17', 'Venezia', 'via Ovest 6','M', '33456700923', 'CSTNTN90L23H620G'),
('MSCMRZ47R27L407K', 'Maurizio', 'Mosca', '1947-10-27', 'Treviso', 'via di Estinzione 2','M', '34945389245', 'CSTNTN90L23H620G'),
('BSCLDA57R12F205U', 'Aldo', 'Biscotto', '1957-10-12', 'Milano', 'via Este 99','M', '32189897583', 'CSTNTN90L23H620G'),
('REIMRN78C58H620N', 'Marina', 'Rei', '1978-03-18', 'Rovigo', 'via Monte Cavallo 23','F', '34879234904', 'RSSVEA87D52G224D'),
('MTTMLY85T70G224D', 'Milly', 'Metti', '1985-12-30', 'Padova', 'via Agrigento 6','F', '34877867590', NULL),
('PSRI95E19G224N33', 'Piero', 'Passarotto', '1993-05-19', 'Padova', 'via Arancio 8','M', '45678291342', 'MLLSML84D12G224I');

INSERT INTO `Abbonato` (`CodiceFiscale`) VALUES
('BRTFRN82R17D34FR'),
('FRRALB91O18M8HVB'),
('MNRDGO64Q03N88HU'),
('PDVTZN88G18A7J87'),
('PRCCRL96G17A658U'),
('RCCELN96G31A345R'),
('RSSMRI72E13G982S'),
('SPNCRL96F08N767J'),
('TLTANN00K28L9IJU'),
('TLTPTR93W27F757H'),
('BRSPLA85S02L736F'),
('BSSFNC93A11L407Q'),
('PGGMNL89E12G224C'),
('MGGVNZ84E07L407J'),
('LSBCLS89C70L407U'),
('PPRGLC77R24G224Z'),
('CGNLEI89T02G224Y'),
('PPESMN87R01L736A'),
('LNGGLC97A17L736H'),
('SMNGPP83D12G224V'),
('NNZMTN89A19F839M'),
('FTOMRN80E57L840F'),
('MCNMLN96R56G224Q');

INSERT INTO `Occasionale` (`CodiceFiscale`, `DataOraEntrata`, `Giorno`) VALUES 
('RSOGLI95C53A757H', '2015-09-01 09:16:24', 'Feriale'),
('PSCMRT97E62G224F', '2014-12-26 19:12:36', 'Festivo'),
('BFOLVI87R52L840U', '2015-01-05 14:22:55', 'Festivo'),
('PSCMRC90C26L407Y', '2015-03-22 11:21:14', 'Feriale'),
('STRMRA73D55L736U', '2015-04-15 08:09:07', 'Feriale'),
('FVRMTN77L59L736Z', '2015-06-10 10:46:35', 'Feriale'),
('FRSPNLRT92A10G4G', '2015-08-15 09:15:22', 'Festivo'),
('SMMGRG50C12G224E', '2015-02-21 17:57:59', 'Feriale'),
('SMMMRC70E19G224E', '2015-03-07 08:58:26', 'Feriale'),
('RDNFNC87A17L736T', '2015-01-10 19:23:25', 'Festivo'),
('MSCMRZ47R27L407K', '2015-05-06 14:13:26', 'Feriale'),
('BSCLDA57R12F205U', '2015-05-11 08:42:21', 'Feriale'),
('REIMRN78C58H620N', '2015-06-08 16:16:17', 'Feriale'),
('MTTMLY85T70G224D', '2015-08-14 20:13:08', 'Festivo'),
('PSRI95E19G224N33', '2015-03-11 14:02:13', 'Feriale');

INSERT INTO `Badge` (`CodAbbonato`, `DataInizio`, `Durata`) VALUES 
('BRTFRN82R17D34FR', '2015-22-06', 'Trimestrale'),
('FRRALB91O18M8HVB', '2015-13-04', 'Semestrale'),
('MNRDGO64Q03N88HU', '2015-01-11', 'Annuale'),
('PDVTZN88G18A7J87', '2014-11-23', 'Annuale'),
('PRCCRL96G17A658U', '2015-08-22', 'Mensile'),
('RCCELN96G31A345R', '2015-08-14', 'Mensile'),
('RSSMRI72E13G982S', '2015-07-09', 'Trimestrale'),
('SPNCRL96F08N767J', '2015-08-31', 'Mensile'),
('TLTANN00K28L9IJU', '2015-28-05', 'Semestrale'),
('TLTPTR93W27F757H', '2015-11-02', 'Annuale'),
('BRSPLA85S02L736F', '2015-08-15', 'Mensile'),
('BSSFNC93A11L407Q', '2015-09-02', 'Mensile'),
('PGGMNL89E12G224C', '2015-07-19', 'Trimestrale'),
('MGGVNZ84E07L407J', '2015-03-30', 'Annuale'),
('LSBCLS89C70L407U', '2015-08-22', 'Mensile'),
('PPRGLC77R24G224Z', '2015-08-26', 'Mensile'),
('CGNLEI89T02G224Y', '2015-08-28', 'Mensile'),
('PPESMN87R01L736A', '2015-09-10', 'Mensile'),
('LNGGLC97A17L736H', '2015-05-01', 'Semestrale'),
('SMNGPP83D12G224V', '2015-06-01', 'Semestrale'),
('NNZMTN89A19F839M', '2014-12-03', 'Annuale'),
('FTOMRN80E57L840F', '2015-09-04', 'Mensile'),
('MCNMLN96R56G224Q', '2015-07-11', 'Trimestrale');

INSERT INTO `Specializzazione` (`CodIstruttore`, `Specialita`) VALUES 
('CNTFLC78B10G224O', 'BioDance'), 
('CNTFLC78B10G224O', 'Capoeira'), 
('CNTFLC78B10G224O', 'Fitness'), 
('LSTRST64C30L736C', 'Kick-Boxing'), 
('LSTRST64C30L736C', 'Kung Fu'), 
('MRNGLR79D52L736P', 'Tai-Chi'), 
('MRNGLR79D52L736P', 'Body Tone'), 
('MRSMRC89E11L736X', 'Pilates'), 
('PTOCRL78M42L406L', 'Crossing Fit'), 
('PTOCRL78M42L406L', 'Yoga'), 
('PTOCRL78M42L406L', 'Power Yoga'), 
('ZRERNN87P62A757W', 'Fitness'),
('PTOCRL78M42L406L', 'Zumba'), 
('CNTFLC78B10G224O', 'Zumba'), 
('MRNGLR79D52L736P', 'Zumba'),
('ZRERNN87P62A757W', 'Crossing Fit'), 
('ZZRMRC74D12G224E', 'Kick-Boxing');

INSERT INTO `Corso` (`CodCorso`, `Giorno`, `Tipo`, `PartecipantiMinimi`, `DataInizio`, `DataFine`, `CodIstruttore`) VALUES 
('WednesdayZumba', 'Wednesday', 'Zumba', '15', '2015-09-16', '2015-12-09', 'PTOCRL78M42L406L'),
('FridayKickBoxing', 'Friday', 'Kick-Boxing', '10', '2015-09-04', '2016-01-15', 'LSTRST64C30L736C'),
('FridayFitness', 'Friday', 'Fitness', '20', '2015-09-18', '2015-12-18', 'CNTFLC78B10G224O'),
('MondayYoga', 'Monday', 'Yoga', '10', '2015-09-14', '2015-11-02', 'PTOCRL78M42L406L'),
('ThursdayKungFu', 'Thursday', 'Kung Fu', '20', '2015-09-10', '2015-10-29', 'LSTRST64C30L736C'),
('TuesdayCrossingFit', 'Tuesday', 'Crossing Fit', '8', '2015-09-08', '2015-09-29', 'PTOCRL78M42L406L'),
('MondayCapoeira', 'Monday', 'Capoeira', '10', '2015-09-07', '2015-09-28', 'CNTFLC78B10G224O'),
('SaturdayPilates', 'Saturday', 'Pilates', '12', '2015-09-12', '2015-11-14', 'MRSMRC89E11L736X'),
('MondayTaiChi', 'Monday', 'Tai-Chi', '15', '2015-09-21', '2015-11-02', 'MRNGLR79D52L736P'),
('ThursdayKickBoxing', 'Thursday', 'Kick-Boxing', '10', '2015-09-10', '2015-11-19', 'LSTRST64C30L736C');

INSERT INTO `Iscrizione` (`CodCliente`, `CodCorso`) VALUES
('BRSPLA85S02L736F', 'FridayFitness'),
('CGNLEI89T02G224Y', 'FridayKickBoxing'),
('PGGMNL89E12G224C', 'MondayTaiChi'),
('PRCCRL96G17A658U', 'SaturdayPilates'),
('SMNGPP83D12G224V', 'ThursdayKungFu');


/*
Trigger e Funzioni
________________________________________________________________
*/


/*
TRIGGER che controlla se un occasionale può iscriversi ad un corso, altrimenti genera un errore
*/

DROP TRIGGER IF EXISTS ControlloGiorno1;
DELIMITER |
CREATE TRIGGER ControlloGiorno1
BEFORE INSERT ON Iscrizione
FOR EACH ROW
BEGIN
IF (New.CodCliente NOT IN (SELECT CodiceFiscale 
			   FROM Abbonato JOIN Badge ON CodiceFiscale=CodAbbonato
 			   WHERE CodiceFiscale=New.CodCliente)) AND 
   (SELECT COUNT(*) 
    FROM Occasionale, Corso
    WHERE CodiceFiscale=New.CodCliente AND CodCorso=New.CodCorso AND DAYNAME(DataOraEntrata)=Corso.Giorno AND 
    DATE(DataOraEntrata)=CURRENT_DATE() AND DATE(DataOraEntrata)>=DataInizio AND DATE(DataOraEntrata)<DataFine 
    )=0 THEN
INSERT INTO Iscrizione SELECT * FROM Iscrizione LIMIT 1;
END IF;
END |
DELIMITER ;


/*
FUNCTION che ritorna l'istruttore che tiene meno corsi e che è specializzato in un certo tipo di corso dando la priorità a chi non tiene corsi. Se più istruttori tengono lo stesso numero di corsi e questo numero è il minimo tra tutti, allora ne restituisco uno a caso (in realtà chi ha il codice fiscale minore)
*/

DROP FUNCTION IF EXISTS IstruttoreMenoImpegnato;
DELIMITER |
CREATE FUNCTION IstruttoreMenoImpegnato (SpecializRichiesta CHAR(25)) RETURNS CHAR(16)
BEGIN
DECLARE NuovoIstruttore CHAR(16);
SELECT CodiceFiscale INTO NuovoIstruttore 
FROM (Istruttore LEFT JOIN Corso ON CodiceFiscale=Corso.CodIstruttore) JOIN Specializzazione ON CodiceFiscale=Specializzazione.CodIstruttore 
WHERE Specialita=SpecializRichiesta AND CodCorso IS NULL AND CodiceFiscale<=ALL(SELECT CodiceFiscale
										FROM (Istruttore LEFT JOIN Corso ON 											CodiceFiscale=Corso.CodIstruttore) JOIN Specializzazione ON 											CodiceFiscale=Specializzazione.CodIstruttore 
										WHERE Specialita=SpecializRichiesta AND CodCorso IS NULL);
IF(NuovoIstruttore IS NOT NULL) THEN  
RETURN NuovoIstruttore;
ELSE
SELECT DISTINCT CodiceFiscale INTO NuovoIstruttore   
FROM (Istruttore JOIN Corso ON CodiceFiscale=Corso.CodIstruttore) JOIN Specializzazione ON CodiceFiscale=Specializzazione.CodIstruttore   
WHERE Specialita=SpecializRichiesta AND CodiceFiscale=ANY(SELECT CodiceFiscale
			 				  FROM (Istruttore JOIN Corso ON CodiceFiscale=Corso.CodIstruttore) JOIN 								  Specializzazione ON CodiceFiscale=Specializzazione.CodIstruttore   
			 			          WHERE Specialita=SpecializRichiesta
							  GROUP BY CodiceFiscale
							  HAVING COUNT(*)<=ALL(SELECT COUNT(*)
		     							       FROM (Istruttore JOIN Corso ON 										       CodiceFiscale=Corso.CodIstruttore) JOIN Specializzazione ON 										       CodiceFiscale=Specializzazione.CodIstruttore 
		     							       WHERE Specialita=SpecializRichiesta
		     							       GROUP BY CodiceFiscale))
				    AND CodiceFiscale<=ALL(SELECT CodiceFiscale
			 				   FROM (Istruttore JOIN Corso ON CodiceFiscale=Corso.CodIstruttore) JOIN 								   Specializzazione ON CodiceFiscale=Specializzazione.CodIstruttore    
			 				   WHERE Specialita=SpecializRichiesta
							   GROUP BY CodiceFiscale
							   HAVING COUNT(*)<=ALL(SELECT COUNT(*)
		     					       	       	        FROM (Istruttore JOIN Corso ON 										        CodiceFiscale=Corso.CodIstruttore) JOIN Specializzazione ON 										        CodiceFiscale=Specializzazione.CodIstruttore 
		     							        WHERE Specialita=SpecializRichiesta
		     							        GROUP BY CodiceFiscale));
RETURN NuovoIstruttore;
END IF;
END |
DELIMITER ;


/*
TRIGGER che:
1) cambia instruttore ad un corso se a questo viene assegnato un istruttore che non ha una specializzazione su quel tipo di corso. Viene scelto l'istruttore, ovviamente che ha quella specializzazione, che tiene meno corsi
2) controlla che il giorno in cui si svolge il corso sia giusto sia per la data di inizio che di fine e che la data d'inizio non venga prima di quella della fine, altrimenti genera un errore 
*/

DROP TRIGGER IF EXISTS ControllaGiornoESpecializ;
DELIMITER |
CREATE TRIGGER ControllaGiornoESpecializ
BEFORE INSERT ON Corso
FOR EACH ROW
BEGIN
IF (SELECT COUNT(*) 
    FROM Specializzazione
    WHERE Specialita=New.Tipo AND (CodIstruttore=New.CodIstruttore OR CodIstruttore=NULL)
   )=0 THEN
SET New.CodIstruttore=IstruttoreMenoImpegnato(New.Tipo);
END IF;
IF (DAYNAME(New.DataInizio)<>New.Giorno OR DAYNAME(New.DataFine)<>New.Giorno OR New.DataInizio>New.DataFine) THEN
INSERT INTO Corso SELECT * FROM Corso LIMIT 1;
END IF;
END |
DELIMITER ;


/*
Versione Update del Trigger precedente
*/

DROP TRIGGER IF EXISTS ControllaGiornoESpecializ2;
DELIMITER |
CREATE TRIGGER ControllaGiornoESpecializ2
BEFORE UPDATE ON Corso
FOR EACH ROW
BEGIN
IF (SELECT COUNT(*) 
    FROM Specializzazione
    WHERE Specialita=New.Tipo AND (CodIstruttore=New.CodIstruttore OR CodIstruttore=NULL)
   )=0 THEN
SET New.CodIstruttore=IstruttoreMenoImpegnato(New.Tipo);
END IF;
IF (DAYNAME(New.DataInizio)<>New.Giorno OR DAYNAME(New.DataFine)<>New.Giorno OR New.DataInizio>New.DataFine) THEN
INSERT INTO Corso SELECT * FROM Corso LIMIT 1;
END IF;
END |
DELIMITER ;


/*
TRIGGER che cambia personal trainer ad un cliente quando quello che lo seguiva viene licenziato(eliminato dal DB). Viene scelto il personal trainer che segue meno clienti dando la priorità a chi non ne segue. Se più personal trainer seguono lo stesso numero di clienti e questo numero è il minimo tra tutti, allora ne restituisco uno a caso (in realtà chi ha il codice fiscale minore)
*/ 

DROP TRIGGER IF EXISTS CambiaPersonalTrainer;
DELIMITER |
CREATE TRIGGER CambiaPersonalTrainer
BEFORE DELETE ON PersonalTrainer
FOR EACH ROW
BEGIN
DECLARE NuovoPersonalTrainer CHAR(16);
SELECT PersonalTrainer.CodiceFiscale INTO NuovoPersonalTrainer 
FROM PersonalTrainer LEFT JOIN Cliente ON PersonalTrainer.CodiceFiscale=CodPersonalTrainer 
WHERE Cliente.CodiceFiscale IS NULL AND PersonalTrainer.CodiceFiscale<=ALL(SELECT PersonalTrainer.CodiceFiscale
						                           FROM PersonalTrainer LEFT JOIN Cliente ON 								                   PersonalTrainer.CodiceFiscale=CodPersonalTrainer 
			 			           		   WHERE Cliente.CodiceFiscale IS NULL);
IF(NuovoPersonalTrainer IS NOT NULL) THEN   
UPDATE Cliente SET CodPersonalTrainer=NuovoPersonalTrainer WHERE CodPersonalTrainer=Old.CodiceFiscale;
ELSE
SELECT DISTINCT PersonalTrainer.CodiceFiscale INTO NuovoPersonalTrainer
FROM PersonalTrainer JOIN Cliente ON PersonalTrainer.CodiceFiscale=CodPersonalTrainer 
WHERE PersonalTrainer.CodiceFiscale=ANY(SELECT PersonalTrainer.CodiceFiscale
		                        FROM PersonalTrainer JOIN Cliente ON PersonalTrainer.CodiceFiscale=CodPersonalTrainer
		                        GROUP BY PersonalTrainer.CodiceFiscale
		                        HAVING COUNT(*)<=ALL(SELECT COUNT(*)
		    					     FROM PersonalTrainer JOIN Cliente ON 								     PersonalTrainer.CodiceFiscale=CodPersonalTrainer 
                    					     GROUP BY PersonalTrainer.CodiceFiscale))
  AND PersonalTrainer.CodiceFiscale<=ALL(SELECT PersonalTrainer.CodiceFiscale
		                         FROM PersonalTrainer JOIN Cliente ON PersonalTrainer.CodiceFiscale=CodPersonalTrainer
		                         GROUP BY PersonalTrainer.CodiceFiscale
		                         HAVING COUNT(*)<=ALL(SELECT COUNT(*)
		    					      FROM PersonalTrainer JOIN Cliente ON 								      PersonalTrainer.CodiceFiscale=CodPersonalTrainer 
                    					      GROUP BY PersonalTrainer.CodiceFiscale));
UPDATE Cliente SET CodPersonalTrainer=NuovoPersonalTrainer WHERE CodPersonalTrainer=Old.CodiceFiscale;
END IF;
END |
DELIMITER ;


/*
FUNCTION che verifica se un certo corso ha raggiunto il numero di iscritti sufficienti per farlo partire, ritorna vero o falso
*/

DROP FUNCTION IF EXISTS NumeroIscrittiSuff;
DELIMITER |
CREATE FUNCTION NumeroIscrittiSuff (CodiceCorso CHAR(28)) RETURNS BOOL
BEGIN
DECLARE IscrittiMinimini INT;
DECLARE IscrittiTotali INT;
DECLARE Sufficiente BOOL;
SELECT PartecipantiMinimi, COUNT(*) INTO IscrittiMinimini,IscrittiTotali
FROM Iscrizione NATURAL JOIN Corso
WHERE CodCorso=CodiceCorso;
IF(IscrittiTotali >= IscrittiMinimini) THEN
SET Sufficiente = 1;
ELSE
SET Sufficiente = 0;
END IF;
RETURN Sufficiente;
END |
DELIMITER ;


/*
FUNCTION che calcola la scadenza di un Badge in base al tipo di abbonamento (durata)
*/

DROP FUNCTION IF EXISTS ScadenzaBadge;
DELIMITER |
CREATE FUNCTION ScadenzaBadge (CodiceAbbonato CHAR(16)) RETURNS DATE
BEGIN
DECLARE DataInizioAbb DATE;
DECLARE TipoAbbonamento ENUM('Mensile', 'Trimestrale', 'Semestrale','Annuale');
DECLARE DataFineAbb DATE;
SELECT DataInizio, Durata INTO DataInizioAbb,TipoAbbonamento
FROM Badge
WHERE CodAbbonato=CodiceAbbonato;
IF(TipoAbbonamento='Mensile') THEN
SET DataFineAbb = DATE_ADD(DataInizioAbb,INTERVAL 1 MONTH);
ELSEIF(TipoAbbonamento='Trimestrale') THEN
SET DataFineAbb = DATE_ADD(DataInizioAbb,INTERVAL 3 MONTH);
ELSEIF(TipoAbbonamento='Semestrale') THEN
SET DataFineAbb = DATE_ADD(DataInizioAbb,INTERVAL 6 MONTH);
ELSEIF(TipoAbbonamento='Annuale') THEN
SET DataFineAbb = DATE_ADD(DataInizioAbb,INTERVAL 1 YEAR);
END IF;
RETURN DataFineAbb;
END |
DELIMITER ;



/*
________________________________________________________________
*/
SET FOREIGN_KEY_CHECKS=1;

