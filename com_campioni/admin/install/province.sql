--
-- Struttura della tabella `#__province`
--

CREATE TABLE IF NOT EXISTS `#__province` (
  `id` int(10) unsigned NOT NULL,
  `id_regione` int(10) unsigned NOT NULL,
  `provincia` text NOT NULL,
  `sigla` varchar(2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `#__province`
--

INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(1, 1, 'Torino', 'TO');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(2, 1, 'Vercelli', 'VC');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(3, 1, 'Novara', 'NO');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(4, 1, 'Cuneo', 'CN');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(5, 1, 'Asti', 'AT');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(6, 1, 'Alessandria', 'AL');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(7, 2, 'Aosta', 'AO');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(8, 7, 'Imperia', 'IM');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(9, 7, 'Savona', 'SV');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(10, 7, 'Genova', 'GE');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(11, 7, 'La Spezia', 'SP');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(12, 3, 'Varese', 'VA');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(13, 3, 'Como', 'CO');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(14, 3, 'Sondrio', 'SO');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(15, 3, 'Milano', 'MI');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(16, 3, 'Bergamo', 'BG');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(17, 3, 'Brescia', 'BS');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(18, 3, 'Pavia', 'PV');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(19, 3, 'Cremona', 'CR');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(20, 3, 'Mantova', 'MN');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(21, 4, 'Bolzano', 'BZ');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(22, 4, 'Trento', 'TN');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(23, 5, 'Verona', 'VR');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(24, 5, 'Vicenza', 'VI');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(25, 5, 'Belluno', 'BL');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(26, 5, 'Treviso', 'TV');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(27, 5, 'Venezia', 'VE');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(28, 5, 'Padova', 'PD');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(29, 5, 'Rovigo', 'RO');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(30, 6, 'Udine', 'UD');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(31, 6, 'Gorizia', 'GO');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(32, 6, 'Trieste', 'TS');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(33, 8, 'Piacenza', 'PC');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(34, 8, 'Parma', 'PR');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(35, 8, 'Reggio Emilia', 'RE');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(36, 8, 'Modena', 'MO');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(37, 8, 'Bologna', 'BO');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(38, 8, 'Ferrara', 'FE');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(39, 8, 'Ravenna', 'RA');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(40, 8, 'Forlì-Cesena', 'FC');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(41, 11, 'Pesaro e Urbino', 'PU');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(42, 11, 'Ancona', 'AN');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(43, 11, 'Macerata', 'MC');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(44, 11, 'Ascoli Piceno', 'AP');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(45, 9, 'Massa-Carrara', 'MS');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(46, 9, 'Lucca', 'LU');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(47, 9, 'Pistoia', 'PT');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(48, 9, 'Firenze', 'FI');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(49, 9, 'Livorno', 'LI');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(50, 9, 'Pisa', 'PI');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(51, 9, 'Arezzo', 'AR');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(52, 9, 'Siena', 'SI');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(53, 9, 'Grosseto', 'GR');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(54, 10, 'Perugia', 'PG');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(55, 10, 'Terni', 'TR');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(56, 12, 'Viterbo', 'VT');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(57, 12, 'Rieti', 'RI');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(58, 12, 'Roma', 'RM');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(59, 12, 'Latina', 'LT');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(60, 12, 'Frosinone', 'FR');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(61, 15, 'Caserta', 'CE');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(62, 15, 'Benevento', 'BN');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(63, 15, 'Napoli', 'NA');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(64, 15, 'Avellino', 'AV');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(65, 15, 'Salerno', 'SA');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(66, 13, 'L''Aquila', 'AQ');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(67, 13, 'Teramo', 'TE');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(68, 13, 'Pescara', 'PE');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(69, 13, 'Chieti', 'CH');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(70, 14, 'Campobasso', 'CB');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(71, 16, 'Foggia', 'FG');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(72, 16, 'Bari', 'BA');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(73, 16, 'Taranto', 'TA');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(74, 16, 'Brindisi', 'BR');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(75, 16, 'Lecce', 'LE');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(76, 17, 'Potenza', 'PZ');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(77, 17, 'Matera', 'MT');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(78, 18, 'Cosenza', 'CS');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(79, 18, 'Catanzaro', 'CZ');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(80, 18, 'Reggio Calabria', 'RC');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(81, 19, 'Trapani', 'TP');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(82, 19, 'Palermo', 'PA');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(83, 19, 'Messina', 'ME');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(84, 19, 'Agrigento', 'AG');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(85, 19, 'Caltanissetta', 'CL');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(86, 19, 'Enna', 'EN');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(87, 19, 'Catania', 'CT');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(88, 19, 'Ragusa', 'RG');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(89, 19, 'Siracusa', 'SR');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(90, 20, 'Sassari', 'SS');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(91, 20, 'Nuoro', 'NU');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(92, 20, 'Cagliari', 'CA');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(93, 6, 'Pordenone', 'PN');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(94, 14, 'Isernia', 'IS');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(95, 20, 'Oristano', 'OR');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(96, 1, 'Biella', 'BI');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(97, 3, 'Lecco', 'LC');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(98, 3, 'Lodi', 'LO');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(99, 8, 'Rimini', 'RN');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(100, 9, 'Prato', 'PO');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(101, 18, 'Crotone', 'KR');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(102, 18, 'Vibo Valentia', 'VV');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(103, 1, 'Verbano-Cusio-Ossola', 'VB');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(104, 20, 'Olbia-Tempio', 'OT');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(105, 20, 'Ogliastra', 'OG');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(106, 20, 'Medio Campidano', 'VS');
INSERT INTO `#__province` (`id`, `id_regione`, `provincia`, `sigla`) VALUES(107, 20, 'Carbonia-Iglesias', 'CI');
