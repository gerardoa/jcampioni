<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
JLoader::register('Provincia', JPATH_COMPONENT_ADMINISTRATOR.DS.'bo'.DS.'provincia.php' );

class Campione
{
	var $_id = null;
	var $_idUtente = null;
	var $_registrazione = null;
	var $_ip = null;
	var $_nome = null;
	var $_cognome = null;
	var $_eta = null;
	var $_email = null;
	var $_indirizzo = null;
	var $_siglaProvincia = null;
	var $_citta = null;
	var $_cap = null;
	var $_kit = null;
	var $_richiestaStato = null;
	var $_figliNum = null;
	var $_figliEtaMedia = null;
	var $_dataSpedizione = null;
	var $_codiceCommento = null;
	var $_dataCommento = null;
	var $_testoCommento = null;
	var $_votoCommento = null;
	/**
	 *
	 * @var Provincia
	 */
	var $_provincia = null;
	/**
	 *
	 * @var Regione
	 */
	var $_regione = null;

	var $_username = null;

	function getRegione() {
		return $this->_regione;
	}

	function setId( $id ) {
		$this->_id = $id;
	}

	function getId() {
		return $this->_id;
	}


	function setIdUtente( $idUtente ) {
		$this->_idUtente = $idUtente;
	}

	function getIdUtente() {
		return $this->_idUtente;
	}

	function setRegistrazione( $registrazione ) {
		$this->_registrazione = $registrazione;
	}

	function getRegistrazione() {
		return $this->_registrazione;
	}


	function setIp( $ip ) {
		$this->_ip = $ip;
	}

	function getIp() {
		return $this->_ip;
	}

	function setNome( $nome ) {
		$this->_nome = $nome;
	}

	function getNome() {
		return $this->_nome;
	}

	function  setCognome( $cognome ) {
		$this->_cognome = $cognome;
	}

	function getCognome() {
		return $this->_cognome;
	}

	function setEta( $eta ) {
		$this->_eta = $eta;
	}

	function getEta() {
		return $this->_eta;
	}

	function setEmail( $email ) {
		$this->_email = $email;
	}

	function getEmail() {
		return $this->_email;
	}

	function setIndirizzo( $indirizzo ) {
		$this->_indirizzo = $indirizzo;
	}

	function getIndirizzo() {
		return $this->_indirizzo;
	}

	function setProvincia( $provincia ) {
		$this->_provincia = $provincia;
	}

	/**
	 *
	 * @return Provincia
	 */
	function getProvincia() {
		if ($this->_provincia) {
			return $this->_provincia;
		}
		// Try to load
		if ($this->_siglaProvincia) {
			static $provinciaModel;
			if (!$provinciaModel) {
				$provinciaModel = JModel::getInstance( 'provincia', 'CampioniModel' );
			}
			$provinciaModel->setSigla($this->_siglaProvincia);
			$this->_provincia = $provinciaModel->load();
			if ($this->_provincia) {
			return $this->_provincia;
			} else {
				$provincia = new Provincia();
				$provincia->setSigla($this->_siglaProvincia);
				return $provincia;
			}
		}
		return null;
	}

	function setCitta( $citta ) {
		$this->_citta = $citta;
	}

	function getCitta() {
		return $this->_citta;
	}

	function setCap( $cap ) {
		$this->_cap = $cap;
	}

	function getCap() {
		return $this->_cap;
	}

	function setKit( $kit ) {
		$this->_kit = $kit;
	}

	function getKit() {
		return $this->_kit;
	}

	function setRichiestaStato( $richiestaStato ) {
		$this->_richiesta_stato = $richiestaStato;
	}

	function getRichiestaStato() {
		return $this->_richiesta_stato;
	}

	function setUserName( $username ) {
		$this->_username = $username;
	}

	function getUserName() {
		return $this->_username;
	}

	function addEtaFiglio( $etaFiglio ) {
		$etaMedia = $this->getFigliEtaMedia();
		$numFigli = $this->getFigliNum();
		if ($etaMedia != 0 && $numFigli != 0) {
			$s1 = ($etaMedia * $numFigli) / ($numFigli + 1);
			$s2 = $etaFiglio / ($numFigli + 1);
			$this->_campione->figli_num = $numFigli + 1;
			$this->_campione->figli_eta_media = $s1 + $s2;
		} else {
			$this->_campione->figli_num = 1;
			$this->_campione->figli_eta_media = $etaFiglio;
		}

	}

	function getFigliNum() {
		return $this->_figliNum;
	}

	function getFigliEtaMedia() {
		return $this->_figliEtaMedia;
	}

	function getNumOrder()
	{
		return $this->_id;
	}

	function setDataSpedizione($data) {
		$this->_dataSpedizione = $data;
	}

	function getDataSpedizione() {
		return $this->_dataSpedizione;
	}

	function getCodiceCommento() {
		return $this->_codiceCommento;
	}

	function setTestoCommento( $text )
	{
		$this->_testoCommento = $text;
	}

	function getTestoCommento()
	{
		return $this->_testoCommento;
	}

	function setVotoCommento( $vote )
	{
		$this->_votoCommento = $vote;
	}

	function getVotoCommento()
	{
		return $this->_votoCommento;
	}

	function toArrayValues()
	{
		$provincia = $this->getProvincia();
		$values = array($this->getId(), $this->getIp(), $this->getNome(), $this->getCognome(),
		$this->getEta(), $this->getEmail(), $this->getIndirizzo(), $provincia->getNome(), $provincia->getSigla(),
		$this->getCitta(), $this->getCap(), $this->getKit(), $this->getFigliNum(), $this->getFigliEtaMedia(),
		$this->getRegistrazione(), $this->getDataSpedizione()
		);
		return $values;
	}
}
?>