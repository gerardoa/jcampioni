--
-- Struttura della tabella `#__regioni`
--

CREATE TABLE IF NOT EXISTS `#__regioni` (
  `id` int(11) unsigned NOT NULL,
  `regione` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `#__regioni`
--

INSERT INTO `#__regioni` (`id`, `regione`) VALUES(1, 'Piemonte');
INSERT INTO `#__regioni` (`id`, `regione`) VALUES(2, 'Valle d''Aosta');
INSERT INTO `#__regioni` (`id`, `regione`) VALUES(3, 'Lombardia');
INSERT INTO `#__regioni` (`id`, `regione`) VALUES(4, 'Trentino-Alto Adige');
INSERT INTO `#__regioni` (`id`, `regione`) VALUES(5, 'Veneto');
INSERT INTO `#__regioni` (`id`, `regione`) VALUES(6, 'Friuli-Venezia Giulia');
INSERT INTO `#__regioni` (`id`, `regione`) VALUES(7, 'Liguria');
INSERT INTO `#__regioni` (`id`, `regione`) VALUES(8, 'Emilia-Romagna');
INSERT INTO `#__regioni` (`id`, `regione`) VALUES(9, 'Toscana');
INSERT INTO `#__regioni` (`id`, `regione`) VALUES(10, 'Umbria');
INSERT INTO `#__regioni` (`id`, `regione`) VALUES(11, 'Marche');
INSERT INTO `#__regioni` (`id`, `regione`) VALUES(12, 'Lazio');
INSERT INTO `#__regioni` (`id`, `regione`) VALUES(13, 'Abruzzo');
INSERT INTO `#__regioni` (`id`, `regione`) VALUES(14, 'Molise');
INSERT INTO `#__regioni` (`id`, `regione`) VALUES(15, 'Campania');
INSERT INTO `#__regioni` (`id`, `regione`) VALUES(16, 'Puglia');
INSERT INTO `#__regioni` (`id`, `regione`) VALUES(17, 'Basilicata');
INSERT INTO `#__regioni` (`id`, `regione`) VALUES(18, 'Calabria');
INSERT INTO `#__regioni` (`id`, `regione`) VALUES(19, 'Sicilia');
INSERT INTO `#__regioni` (`id`, `regione`) VALUES(20, 'Sardegna');
