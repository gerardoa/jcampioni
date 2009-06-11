DROP TABLE IF EXISTS `#__campioni_richieste`;

CREATE TABLE IF NOT EXISTS `#__campioni_richieste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utente` int(11) NOT NULL,
  `registrazione` datetime NOT NULL,
  `ip` varchar(255) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `eta` tinyint(4) NOT NULL,
  `email` varchar(50) NOT NULL,
  `indirizzo` int(50) NOT NULL,
  `provincia` int(20) NOT NULL,
  `citta` int(30) NOT NULL,
  `cap` int(11) NOT NULL,
  `kit` varchar(255) NOT NULL,
  `richiesta_stato` varchar(255) DEFAULT NULL,
  `figli_num` tinyint(4) DEFAULT NULL,
  `figli_eta_media` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;