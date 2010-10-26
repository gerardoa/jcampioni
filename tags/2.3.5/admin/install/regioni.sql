--
-- Struttura della tabella `#__regioni`
--

CREATE TABLE IF NOT EXISTS `#__regioni` (
  `id` int(11) unsigned NOT NULL,
  `regione` text NOT NULL,
  `region_code` varchar(255),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `#__regioni`
--

INSERT INTO `#__regioni` (`id`, `regione`, `region_code`) VALUES(1, 'Piemonte', 'IT-21');
INSERT INTO `#__regioni` (`id`, `regione`, `region_code`) VALUES(2, 'Valle d''Aosta', 'IT-23');
INSERT INTO `#__regioni` (`id`, `regione`, `region_code`) VALUES(3, 'Lombardia', 'IT-25');
INSERT INTO `#__regioni` (`id`, `regione`, `region_code`) VALUES(4, 'Trentino-Alto Adige', 'IT-32');
INSERT INTO `#__regioni` (`id`, `regione`, `region_code`) VALUES(5, 'Veneto', 'IT-34');
INSERT INTO `#__regioni` (`id`, `regione`, `region_code`) VALUES(6, 'Friuli-Venezia Giulia', 'IT-36');
INSERT INTO `#__regioni` (`id`, `regione`, `region_code`) VALUES(7, 'Liguria', 'IT-42');
INSERT INTO `#__regioni` (`id`, `regione`, `region_code`) VALUES(8, 'Emilia-Romagna', 'IT-45');
INSERT INTO `#__regioni` (`id`, `regione`, `region_code`) VALUES(9, 'Toscana', 'IT-52');
INSERT INTO `#__regioni` (`id`, `regione`, `region_code`) VALUES(10, 'Umbria', 'IT-55');
INSERT INTO `#__regioni` (`id`, `regione`, `region_code`) VALUES(11, 'Marche', 'IT-57');
INSERT INTO `#__regioni` (`id`, `regione`, `region_code`) VALUES(12, 'Lazio', 'IT-62');
INSERT INTO `#__regioni` (`id`, `regione`, `region_code`) VALUES(13, 'Abruzzo', 'IT-65');
INSERT INTO `#__regioni` (`id`, `regione`, `region_code`) VALUES(14, 'Molise', 'IT-67');
INSERT INTO `#__regioni` (`id`, `regione`, `region_code`) VALUES(15, 'Campania', 'IT-72');
INSERT INTO `#__regioni` (`id`, `regione`, `region_code`) VALUES(16, 'Puglia', 'IT-75');
INSERT INTO `#__regioni` (`id`, `regione`, `region_code`) VALUES(17, 'Basilicata', 'IT-77');
INSERT INTO `#__regioni` (`id`, `regione`, `region_code`) VALUES(18, 'Calabria', 'IT-78');
INSERT INTO `#__regioni` (`id`, `regione`, `region_code`) VALUES(19, 'Sicilia', 'IT-82');
INSERT INTO `#__regioni` (`id`, `regione`, `region_code`) VALUES(20, 'Sardegna', 'IT-88');