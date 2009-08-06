CREATE TABLE IF NOT EXISTS `#__campioni_richieste` ( 
`id` int(11) NOT NULL AUTO_INCREMENT, 
`id_utente` int(11) NOT NULL, 
`registrazione` datetime NOT NULL, 
`ip` varchar(128) NOT NULL, 
`nome` varchar(32) NOT NULL,
`cognome` varchar(32) NOT NULL,
`eta` tinyint(4) NOT NULL, 
`email` varchar(64) NOT NULL, 
`indirizzo` varchar(64) NOT NULL, 
`provincia` varchar(32)	NOT NULL, 
`citta` varchar(32) NOT NULL, 
`cap` int(5) unsigned zerofill NOT NULL, 
`kit` varchar(64) NOT NULL, 
`richiesta_stato` varchar(32) DEFAULT NULL, 
`figli_num` tinyint(4) DEFAULT NULL, 
`figli_eta_media` float DEFAULT NULL, 
`data_spedizione` datetime NULL DEFAULT NULL,
`codice_commento` INT NULL,
PRIMARY KEY (`id`) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;
			
